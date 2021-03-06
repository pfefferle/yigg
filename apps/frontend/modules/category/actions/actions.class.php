<?php

/**
 * category actions.
 *
 * @package    yigg
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends yiggActions {
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $this->categories = Doctrine::getTable("Category")->findAll();
  }

  /**
   * Executes show action
   *
   * @param sfRequest $request A request object
   */
  public function executeShow(sfWebRequest $request) {
    $this->setLayout("layout.stream");
    $this->category = $this->getRoute()->getObject();

    $sf = new yiggStoryFinder();
    $sf->confineWithCategory($this->category->getId());
    $sf->sortByDate();

    // just return query for pager creation
    $this->limit = 10;
    $this->stories = $this->setPagerQuery($sf->getQuery())->execute();

    $this->storyCount = count($this->stories);
    if( $this->storyCount > 0 ) {
      $this->populateStoryAttributeCache();
    }

    $this->getResponse()->setTitle( sprintf('Alles zur Kategorie %s', $this->category->name ));
    $this->getResponse()->addMeta('keywords', $this->category->name );
    $this->getResponse()->addMeta('description', sprintf('Auf dieser Seite findest du alles auf YiGG zur Kategorie %s.',$this->category->name));

    return sfView::SUCCESS;
  }
}
