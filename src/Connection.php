<?php

namespace ZTE;

class Connection
{

  private $_modem_ip = "";
  private $_type = "";

  public function __construct($modem_ip, $type)
  {
    $this->_modem_ip = $modem_ip;
    $this->_type = $type;
  }

  /*
  * Enable or Disable Connection
  * return @array or @string
  */
  public function disable_enable()
  {
    if ( ($this->_type!= "DIS") && ($this->_type != "ENA") ) {
      return "Error_-_Invalid_Wifi_Type";
    }

    $data ="isTest=false";
    $data .="&notCallback=true";

    if ($this->_type == "DIS") {
      $data .="&goformId=DISCONNECT_NETWORK";
    }

    if ($this->_type == "ENA") {
      $data .="&goformId=CONNECT_NETWORK";
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
