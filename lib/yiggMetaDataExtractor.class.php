<?php
class yiggMetaDataExtractor
{
  const TIMEOUT = 5;

  private $url,
          $response,
          $yiggMeta;

  public function __construct($url)
  {
    $this->url = $url;
    $this->loadData();
    $this->fetchData();
  }

  public function getReadableDescription()
  {
	  return $this->yiggMeta->getDescription();
  }

  public function getMetaTags()
  {
    return $this->yiggMeta->getTags();
  }

  public function getTitle()
  {
    return $this->yiggMeta->getTitle();
  }

  /**
   * Fetches data from a remote server
   */
  private function loadData()
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);

    $this->response = curl_exec($ch);
    $content = iconv(mb_detect_encoding($this->response.'a', 'UTF-8, ISO-8859-1'),"UTF-8",$this->response);
    curl_close($ch);
  }

  private function cleanValue($value)
  {
    $value = html_entity_decode($value, ENT_QUOTES);
    $value = trim($value);
    $value = strip_tags($value);

    return $value;
  }
  
  /**
   * handles the parsing of a new social-object
   * currently parsed: opengraph and metatags
   *
   * @param string $pUrl
   * @return array $pArray
   */
  public function fetchData() {
    if (!$this->response) {
      return false;
    }
    
    $html = $this->response;
    $url = $this->url;

    // boost performance and use alreade the header
    $header = substr( $html, 0, stripos( $html, '</head>' ) );

    if (!$this->yiggMeta) {
      $this->yiggMeta = new YiggMeta();
    }

    $this->yiggMeta->setUrl($url);

    if ((preg_match('~http://opengraphprotocol.org/schema/~i', $header) || preg_match('~http://ogp.me/ns#~i', $header) || preg_match('~property=[\"\']og:~i', $header)) && !$this->yiggMeta->isComplete()) {
      //get the opengraph-tags
      $openGraph = OpenGraph::parse($header);
      $this->yiggMeta->fromOpenGraph($openGraph);
    }

    if ((preg_match('~application/(xml|json)\+oembed"~i', $header)) && !$this->yiggMeta->isComplete()) {
      try {
        $oEmbed = OEmbedParser::fetchByCode($header);
        $this->yiggMeta->fromOembed($oEmbed);
      } catch (Exception $e) {
        // catch exception and try to go on
      }
    }

    if (!$this->yiggMeta->isComplete()) {
      $meta = MetaTagParser::getKeys($html, $url);
      $this->yiggMeta->fromMeta($meta);
    }
  }
}