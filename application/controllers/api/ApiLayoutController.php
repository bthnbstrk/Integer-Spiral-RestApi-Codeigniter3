<?php

defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class ApiLayoutController extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("layouts_model");
        $this->load->library('unit_test');
    }

    public function index_get()
    {
        $layouts = new Layouts_model();
        $result = $layouts->get_layouts();

        if ($result) {
            $this->response($result, 200);
        } else {
            $this->response(
                [
                    'status' => false,
                    'message' => 'NOT FOUND LAYOUTS'
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

    public function create_post()
    {
        if ($this->input->post("point_x") === ''
            || $this->input->post("point_y") === '') {
            $this->response(
                [
                    'status' => false,
                    'message' => 'ALL FIELDS REQUIRED'
                ],
                RestController::HTTP_BAD_REQUEST
            );
        } else {
            $point_x = (is_numeric($this->input->post("point_x"))) ? intval($this->input->post("point_x")) : 'No';
            $point_y = (is_numeric($this->input->post("point_y"))) ? intval($this->input->post("point_y")) : 'No';

            $this->unit->run($point_x, 'is_int', "Check X Point");
            $this->unit->run($point_y, 'is_int', "Check Y Point");

            $controls = $this->unit->result();

            foreach ($controls as $control) {
                if ($control['Result'] == "Failed") {
                    $this->response(
                        [
                            'status' => false,
                            'message' => 'FAILED TO X_POINT OR Y_POINT TYPE'
                        ],
                        RestController::HTTP_BAD_REQUEST
                    );
                }
            }

            $layout = new Layouts_model();
            $coordinates = $layout->result_coordinate($point_x, $point_y);

            $data = [
                'point_x' => $point_x,
                'point_y' => $point_y,
                'coordinates' => $coordinates,
                "created_at" => date("Y-m-d H:i:s")
            ];

            $result = $layout->add($data);

            if ($result > 0) {
                $this->response(
                    [
                        'status' => true,
                        'message' => $result
                    ],
                    RestController::HTTP_CREATED
                );
            } else {
                $this->response(
                    [
                        'status' => false,
                        'message' => 'FAILED TO CREATE ATTENDANCE'
                    ],
                    RestController::HTTP_BAD_REQUEST
                );
            }
        }
    }

    public function layout_get($id)
    {
        $layout_id = (is_numeric($id)) ? intval($id) : 'No';
        $this->unit->run($layout_id, 'is_int', "Check ID");
        $controls = $this->unit->result();

        if ($controls[0]['Result'] == "Failed") {
            $this->response(
                [
                    'status' => false,
                    'message' => 'FAILED TO X_POINT OR Y_POINT TYPE'
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }


        if ($this->input->post("layout_id") === '') {
            $this->response(
                [
                    'status' => false,
                    'message' => 'ALL FIELDS REQUIRED'
                ],
                RestController::HTTP_BAD_REQUEST
            );
        } else {
            $layout = new Layouts_model();
            $layout = $layout->get(["id" => $layout_id]);

            if ($layout) {
                $this->response(
                    [
                        'status' => true,
                        'message' => $layout
                    ],
                    RestController::HTTP_CREATED
                );
            } else {
                $this->response(
                    [
                        'status' => false,
                        'message' => 'NOT FOUND LAYOUT'
                    ],
                    RestController::HTTP_BAD_REQUEST
                );
            }
        }
    }

}

?>