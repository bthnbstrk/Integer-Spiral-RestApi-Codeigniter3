<?php

  class Layouts_model extends CI_Model
  {

    public $tableName = "layouts";

    public function __construct()
    {
      parent::__construct();

    }

    public function get($where = array())
    {
      return $this->db->where($where)->get($this->tableName)->row();
    }

    public function add($data = array())
    {

      $this->db->insert($this->tableName, $data);
      $insert_id = $this->db->insert_id();
      return $insert_id;

    }

    public function get_layouts()
    {
      return $this->db->select("id,point_x,point_y")->order_by("id DESC")->get($this->tableName)->result();
    }

    public  function create_coordinates($x, $y,&$a)
    {

      $val = 1;


      $k = 0;
      $l = 0;


      while ($k < $x && $l < $y) {
        /* Print the first row from
        the remaining rows */
        for ($i = $l; $i < $y; ++$i)
          $a[$k][$i] = $val++;

        $k++;

        /* Print the last column from
        the remaining columns */
        for ($i = $k; $i < $x; ++$i)
          $a[$i][$y - 1] = $val++;
        $y--;

        /* Print the last row from
        the remaining rows */
        if ($k < $x) {
          for ($i = $y - 1; $i >= $l; --$i)
            $a[$x - 1][$i] = $val++;
          $x--;
        }

        /* Print the first column from
           the remaining columns */
        if ($l < $y) {
          for ($i = $x - 1; $i >= $k; --$i)
            $a[$i][$l] = $val++;
          $l++;
        }
      }


    }

    public  function result_coordinate($x,$y){


      $this->create_coordinates($x,$y,$a);

      $result=array();
      for ($i = 0; $i < $x; $i++)
      {
        for ($j = 0; $j < $y; $j++)
        {
          $point = "x_point:" . $i . ",y_point:" . $j . ",value:" . $a[$i][$j];
          array_push($result, $point);
        }
      }

      return json_encode($result);

    }


  }