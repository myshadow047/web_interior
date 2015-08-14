<?php

class product extends app_crud_controller {

    function _save($id = null) {
        $this->_view = $this->_name . '/show';

        if ($_POST) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['upload_path'] = 'data/product/image';
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);

            if (!file_exists('./data/product/image')) {
                mkdir('./data/product/image', 0777, true);
            }

            $_POST['id'] = $id;
            try {
                $id = $this->_model()->save($_POST, $id);

                if ($_FILES['images']['name'][0] ) {
                    foreach ($_FILES as $k => $file) {
                        $this->upload->do_upload('images');
                        $images = $this->upload->data();
                    }

                    foreach ($images as $image) {
                        $data = array(
                            'product' => $id,
                            'image_name' => $image['file_name']
                        );
                        $this->_model()->before_save($data);
                        $this->db->insert('product_image', $data);
                    }
                }

                $referrer = $this->session->userdata('referrer');
                if (empty($referrer)) {
                    $referrer = $this->_get_uri('listing');
                }

                add_info( ($id) ? l('Record updated') : l('Record added') );

                if (!$this->input->is_ajax_request()) {
                    redirect($referrer);
                }
            } catch (Exception $e) {
                add_error(l($e->getMessage()));
            }
        } else {
            $where = array('status' => 1);
            $categories = $this->db->get_where('category', $where)->result_array();
            $cat = array('' => 'Select Category');

            foreach ($categories as $k => $category) {
                $cat[$category['id']] = $category['name'];
            }
            $this->_data['categories'] = $cat;

            if ($id !== null) {
                $where = array('status' => 1, 'product' => $id);
                $images = $this->db->get_where('product_image', $where)->result_array();

                $this->_data['images'] = $images;
                $this->_data['id'] = $id;
                $_POST = $this->_model()->get($id);
                if (empty($_POST)) {
                    show_404($this->uri->uri_string);
                }
            }
            $this->load->library('user_agent');
            $this->session->set_userdata('referrer', $this->agent->referrer());
        }
        $this->_data['fields'] = $this->_model()->list_fields(true);
    }

    function delete_one_image($id, $product_id) {
        $data = $this->db->get_where('product_image', array('id' => $id))->row_array();

        unlink('data/product/image/' . $data['image_name']);

        $this->db->delete('product_image', array('id' => $id));

        redirect('product/edit/' . $product_id);
    }
}