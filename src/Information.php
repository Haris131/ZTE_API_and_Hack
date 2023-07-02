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
    $data .= '&cmd=model_name,network_provider,network_type,wan_ipaddr,lte_rsrp,lte_rsrq,lte_rssi,lte_snr,cell_id,lac_code,hmcc,hmnc,rmcc,rmnc,rssi,imei,sim_imsi,wa_inner_version,web_version';

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
