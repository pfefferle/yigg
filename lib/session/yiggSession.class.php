<?php

/**
 * yiggSession Class reperesents the data saved in session, along with session
 * information and, after login: user data record .
 *
 * @package   yigg
 * @subpackage   user
 */
class yiggSession extends sfBasicSecurityUser
{

  // available security credentials
  private $available_credentials = array(
      'ADMIN'        => 1,
      'MODERATOR'    => 2,
      'POWERUSER'    => 3,
      'SEO'          => 4,
      'CORPORATE_ACCOUNT'  => 5
  );

  private $user = null;

  public function getLoginLink()
  {
    return '@user_login';
  }

  public function getLogoutLink()
  {
    return '@user_logout';
  }

  public function getRegisterLink()
  {
    return '@user_register';
  }

  /**
   * Performs the functions of login for the current user
   * @param Object User - propel object of the User record from the database
   * @param int remember - true or false depending on if you want a cookie.
   */
  public function login( $user, $remember = false)
  {
    if( $user instanceof User )
    {
      // Authenticate and set login information for the user.
      $this->setAuthenticated( true );
      $this->setFlash('dte:last_login', $user->last_login);

      // Update the data for reference
      $user->last_login = yiggTools::getDbDate();
      $user->last_ip =  sfContext::getInstance()->getRequest()->getRemoteAddress();
      $user->failed_logins = 0;

      $this->setAttribute('FailedLogins', 0 );

      // Enable persistant logins
	    $this->createRememberKey( $user );

      $user->save();

      $credential_names = array_flip( $this->available_credentials );
      foreach (  $user->Permissions->toArray() as $permission ) {
        $this->addCredential($credential_names[$permission['permission_level']]);
      }

      // Set flash for registering the user at ivw
      $this->setFlash('ivw:mclient:register', $user['mclient_salt']);

      $this->getAttributeHolder()->removeNamespace('StoryRatings');
      //  Make the user object avaliable accross our application.
      $this->setAttribute( 'user_id', $user['id'], 'session');
      $this->user = $user;
    }
  }

  /**
   * Makes the user wait for longer and longer each time they fail a request.
   */
  public function enforceWait( $maxFailedAttempts , $reason = 'failing login') {
    if( $maxFailedAttempts > sfConfig::get("sf_allowed_failed_logins") ) {
      $secondsToSleep = $maxFailedAttempts * 2;
      $logmessage = 'yiggSession->enforceWait enforcing wait for naughty user for '.$reason. ' after ' . $maxFailedAttempts .' failed attempts.';
      $logmessage .= 'sleeping for ' .$secondsToSleep.' seconds with IP: ' . sfContext::getInstance()->getRequest()->getRemoteAddress();
      sfContext::getInstance()->getLogger()->log( $logmessage , 3);
      return sleep ( $secondsToSleep );
    } else {
      return 0;
    }
  }

  /**
   * Performs the logout for the current user.
   */
  public function logout() {
    $this->getAttributeHolder()->removeNamespace('session');
    $this->getAttributeHolder()->removeNamespace('StoryRatings');

    $this->setAuthenticated(false);
    $this->user = false;
    $this->clearCredentials();
    $this->removeRememberKey();
    $this->shutdown();
  }

  /**
   * Creates a remember key for the user based on the users credentials,
   * and a date.
   *
   * @param Doctrine_Record $user
   * @return void
   */
  public function createRememberKey( $user )
  {
    // determine a random key and save it to the user
    $rememberKey = RememberKey::create( $user );
    $remembermeData = array( $rememberKey->remember_key , $rememberKey->created_at );

    // Serialise and save the data
    $value = base64_encode( serialize( $remembermeData ) );
    $response = sfContext::getInstance()->getResponse();
    $response->setCookie('YGID', $value, strtotime( $rememberKey->created_at ) + 60*60*24*15, '/');
  }

  /**
   * Returns true or false if the rememberkey has been set
   *
   * @return unknown
   */
  public function hasRememberKey()
  {
    $data = sfContext::getInstance()->getRequest()->getCookie('YGID');
    return $data ? true : false;
  }

  /**
   * Removes the cookie by setting the date in the past.
   * @return void.
   */
  public function removeRememberKey()
  {
    $response = sfContext::getInstance()->getResponse();
    $request =  sfContext::getInstance()->getRequest();
    $negTime = time() - 60*60 * 24;

    if( false !== $request->getCookie('YGID', false) )
    {
      $response->setCookie("YGID",false,$negTime);
    }
    return;
  }

  /**
   * Will let you know if the user is currently attached to the session (IE
   * logged in.)
   */
  public function hasUser() {
    if ( (false === $this->isTimedOut()) && (true === $this->isAuthenticated()) ) {
      // if it's been populated already, return true.
      if( $this->user instanceof User ) {
        return true;
      }

      // find the id and cache the link the session
      $user_id = $this->getUserId();
      if( null !== $user_id )
      {
        $user = Doctrine::getTable("User")->findOneById( $user_id );
        if( $user instanceof User )
        {
          $this->user = $user;
          return true;
        }
      }
    }
    return false;
  }

  /**
   * Proxy function for returning the Current User id
   * @return int or false
   */
  public function getUserId() {
    return $this->getAttribute('user_id', false, 'session');
  }

  /**
   * Returns true if the currently logged in user is an Administrator.
   *
   * @return Boolean
   */
  public function isAdmin() {
    return $this->hasCredential( array( 'ADMIN' ), $useAnd = false);
  }

  public function isModerator() {
    return $this->hasCredential( array('ADMIN','MODERATOR'),false);
  }


  /**
   * overwriting isAuthenticated to check for user_id otherwise
   * we don't know who the sessssion is associated with.
   *
   * @see lib/1.2/user/sfBasicSecurityUser#isAuthenticated()
   * @return boolean
   */
  public function isAuthenticated() {
    // check the standard session stuff.
    if( true === parent::isAuthenticated()) {
      // make sure the session has the user_id attribute.
      $user_id = $this->getUserId();

      if(false !== $user_id && $user_id > 0) {
        return true;
      }
    }
    return false;
  }

  /**
   * Returns the currently logged in User record. (if avaliable)
   * use as a fallback if the call syntax doesnt work.
   * @return $User
   */
  public function getUser() {
    if( false === $this->isTimedOut() && true === $this->isAuthenticated() ) {
      if( $this->user instanceof User ) {
        return $this->user;
      }

      // Make sure we had/have a user_id from session.
      $user_id = $this->getAttribute('user_id', null, 'session');
      if( false !== $user_id ) {
        $this->user = Doctrine::getTable("User")->findOneById( $user_id );
        if( false === $this->user) {
          // throws a stop exception.
          $deleted = Doctrine::getTable("User")->isDeleted($user_id);
          if(false === $deleted) {
           sfContext::getInstance()->getLogger()->log("yiggSession::getUser() couldn't load user (was not deleted) for id #" .  $this->getAttribute('user_id',null, 'session') , sfLogger::ERR);
          }

          $this->logout();
          return sfContext::getInstance()->getController()->redirect("@user_login");
        }
        return $this->user;
      }
    }
    return false;
   }

  /**
   * returns the time since the last login.
   */
  public function getTimeSinceLogin() {
    $user = $this->getUser();
    if(false !== $user) {
      return yiggTools::timeDiff( $user->getLastLogin("H:i d.m.Y") );
    }
  }


  /**
   * Populates the StoryRating cache for this user.
   */
  public function preCacheRatings() {
    $query = Doctrine_Query::create()
      ->select("sr.story_id")
      ->from('StoryRating sr INDEXBY sr.story_id')
      ->innerJoin('sr.Rating r')
      ->where('r.created_at > (NOW() - INTERVAL 2 DAY)')
      ->groupBy("sr.story_id");

    $ip_address = sfContext::getInstance()->getRequest()->getRemoteAddress();

    if ( true == $this->hasUser()) {
      $query->addWhere('sr.user_id = :userid', array( ':userid' => $this->getUser()->id ));
    } else {
      $query->addWhere('r.ip_address = :ip', array(":ip" => $ip_address));
    }

    $this->setAttribute("StoryRatings", $query->execute(array(), Doctrine::HYDRATE_ARRAY), "StoryRatings");
  }

  /**
   * uses the cache to minimize the queries for recent stories and votes.
   *
   * @param integer $story_id
   * @return Boolean
   */
  public function hasRated( $story_id ) {
    // load the Ratings, if not present already.
    if (false === $this->hasAttribute("StoryRatings", "StoryRatings")) {
      $this->preCacheRatings();
    }

    // get the Ratings. and check cache first.
    $storyRatings = $this->getAttribute("StoryRatings", array(), "StoryRatings");

    if ( true === array_key_exists( $story_id, $storyRatings) ) {
      return true;
    } else {
      // do a manual lookup just to be sure.
      $result =  StoryRatingTable::retrieveHasRated( $story_id, $this->hasUser() ? $this->getUser(): null );

      if ( true === $result ) {
        // update the cache.
        $storyRatings[ $story_id ] = $result;
        $this->setAttribute("StoryRatings", $storyRatings, "StoryRatings");
        return true;
      }
    }
    // mustn've voted yet
    return false;
  }

  /**
   * removes the tmp namespace from the attribute holder,
   * this can be used for any tmp values stored for the request,
   * but NOT persistant, or need of saving in sessions
   *
   * @see lib/1.3/user/sfBasicSecurityUser#shutdown()
   */
  public function shutdown() {
    $this->attributeHolder->removeNamespace("tmp");
    parent::shutdown();
  }

  /**
   * remember a target ot redirect the user after the next
   * successful login
   * @param  sfWebRequest $pRequest
   */
  public function setRedirectAfterNextLogin( $redirect ){
  	$this->setAttribute( 'target_after_login', $redirect );
  }
}
