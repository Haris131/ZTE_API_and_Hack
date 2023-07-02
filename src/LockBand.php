<?php
namespace ZTE;

class LockBand
{

  private $_modem_ip = "";
  private $_type = "";

  public function __construct($modem_ip, $type)
  {
    $this->_modem_ip = $modem_ip;
    $this->_type = $type;
  }

  /*
  * Lock Band
  * return @array or @string
  */
  function lock_unlock_band()
  {

    if ( ($this->_type!="ALL") && ($this->_type!="B1") && ($this->_type!="B3") && ($this->_type!="B8") && ($this->_type!="B40") ) {
      return "Wan: Invalid Type (ALL) OR (B1) OR (B3) OR (B8) OR (B40)";
    }

    $data = 'isTest=false';
    $data .= '&goformId=SET_LTE_BAND_LOCK';

    if ($this->_type=="ALL") {
      $data .= '&lte_band_lock=all';
    }

    if ($this->_type=="B1") {
      $data .= '&lte_band_lock=2100M';
    }

    if ($this->_type=="B3") {
      $data .= '&lte_band_lock=1800M';
    }

    if ($this->_type=="B8") {
      $data .= '&lte_band_lock=900M';
    }

    if ($this->_type=="B40") {
      $data .= '&lte_band_lock=2300M';
    }

    $curl = new Curl($this->_modem_ip, 'POST', $data);
    $result = $curl->get_post();
    $json = new Json('DEC', $result);
    $decode = $json->decode_encode();

    $ret['data'] = $data;
    $ret['result'] = $result;
    $ret['decode'] = $decode;

    return $ret;
  }

}
