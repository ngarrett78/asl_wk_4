<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	// Gallery Model

    // new record for storing uploaded image
        public function create($data)
        {
            try {
                $this->db->insert('images', $data);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    // Retreive all records from table 'images'
        public function all()
        {
            $result = $this->db->get('images');
            return $result;
        }

    // retrieve record by its ID - READ
        public function find($id)
        {
            $row = $this->db->where('id', $id)->limit(1)->get('images');
            return $row;
        }

    // Update record by its ID - Update
        public function update($id, $data)
        {
            try {
                $this->db->where('id', $id)->limit(1)->update('images', $data);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    // Delete by ID - Delete
        public function delete($id)
        {
            try {
                $this->db->where('id',$id)->delete('images');
                return true;
            }

                //catch exception
            catch(Exception $e) {
                echo $e->getMessage();
            }
        }



}