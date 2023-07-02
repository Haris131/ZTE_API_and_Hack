<?php

namespace ZTE;

class Information
{

  private $_modem_ip = "";

  public function __construct($modem_ip)
  {
    $this->_modem_ip = $modem_ip;
  }

  /*
  * Device Information
  * return @array or @string
  */
  public function dev_info()
  {

    $data = '?multi_data=1';
    $data .= '&cmd=model_name,network_provider,network_type,lte_rsrp,lte_rsrq,lte_rssi,cell_id,lac_code,hmcc,hmnc,rmcc,rmnc,rssi';

    $curl = new Curl($this->_modem_ip, 'GET', $data);
    $result = $curl->get_post();
    $json = new Json('DEC', $result);
    $decode = $json->decode_encode();

    $ret['data'] = $data;
    $ret['result'] = $result;
    $ret['decode'] = $decode;

    return $ret;
  }

}
