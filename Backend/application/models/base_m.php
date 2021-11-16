<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_m extends CI_Model {

    protected $table;

    protected $primaryKey = 'id';

    protected $fillable = array();

    protected $timestamp = false;

    public function get() {
        return $this->db->get($this->table);
    }

    public function find($id) {
        return $this->db->where($this->primaryKey, $id)->get($this->table)->row();
    }

    public function insert($record) {
        $record =  $this->fillable($record);
        if ($this->timestamp) {
            $record['created_at'] = date('Y-m-d H:i:s');
            $record['updated_at'] = date('Y-m-d H:i:s');
        }
        return $this->db->insert($this->table, $record);
    }

    public function update($id, $record) {
        $record =  $this->fillable($record);
        if ($this->timestamp) {            
            $record['updated_at'] = date('Y-m-d H:i:s');
        }
        return $this->db->where($this->primaryKey, $id)->update($this->table, $record);
    }

    public function delete($id) {
        return $this->db->where($this->primaryKey, $id)->delete($this->table);
    }

    public function fillable($record) {
        $data = array();
        foreach ($this->fillable as $fillable) { 
          $formatters = array();         
          $parse = explode(':', $fillable);
          if (count($parse) > 1) {
            $fillable = $parse[0];              
            $formatters = explode('|', $parse[1]);
          }          
          if (isset($record[$fillable])) {            
            if (count($formatters) <> 0) {
                foreach ($formatters as $formatter) {
                    switch ($formatter) {
                        case 'date':
                            $data[$fillable] = date('Y-m-d', strtotime($record[$fillable]));
                            break;                    
                        default:
                            $data[$fillable] = $record[$fillable];
                            break;
                    }                
                }
            } else {
                $data[$fillable] = $record[$fillable];
            }
          }
        }
        return $data;
    }
}