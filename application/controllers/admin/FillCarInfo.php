<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH. 'core/Base_Controller.php';

class FillCarInfo extends Base_Controller
{
    public function __construct() {
        parent::__construct();
        $this->isAdmin = true;
        $this->check_token();
        $this->load->model('admin/FillCarInfo_model', 'fillcar');
    }

    public function get_fill_step() {
        $params = $this->input->get();
        $carId = get_param($params, 'carId', '');
        if($carId == '') {
          $this->return_fail('carId错误');
        }
        $result = $this->fillcar->get_fill_step($this->token->userInfo['user_id'], $carId);
        $this->return_result($result);
    }

    public function get_year_month() {
        $result = $this->fillcar->get_year_month();
        $this->return_success($result);
    }

    public function get_fill_car_info() {
        $params = $this->input->get();
        $carId = get_param($params, 'carId', '');
        if($carId == '') {
          $this->return_fail('carId错误');
        }
        $result = $this->fillcar->get_fill_car_info($this->token->userInfo['user_id'], $carId);
        $this->return_result($result);
    }

    public function fill_car_first_step() {
        $params = $this->input->post();
        $key = array(
          'carId',
          'baseInfo',
          'configBase',
          'configEngine',
          'configChassisBrake',
          'configSafety',
          'configOut',
          'configIn'
        );
        $option = elements($key, $params, '');
        if($option['carId'] == '') {
          $this->return_fail('carId错误');
        }
        $this->resutn_success($option);
    }
}
