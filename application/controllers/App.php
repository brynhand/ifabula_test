<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is App Controller
*/
class App extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'm_user'
        ));
    }

    function index() {
        $have_session = $this->acl->getMySession(true);

        if($have_session)
            redirect('dashboard');
        else
            $this->login();
    }

    function login() {
        $submit = $this->input->post('submit');

        if($submit) {
            $this->form_validation->set_rules('username', lang('username'), 'required');
            $this->form_validation->set_rules('password', lang('password'), 'required');

            if($this->form_validation->run() !== TRUE) {
                return JSONRES(_ERROR, validation_errors());
            }

            $filter = array(
                'username' => $this->input->post('username'),
                'password' => encrypt($this->input->post('password'))
            );
            list($flag, $user) = $this->m_user->login($filter);

            if(!empty($user)) {
                if($flag !== true)
                    return JSONRES(_ERROR, $user);

                // Get Dashboard Access
                $user_group = $this->m_user->get_user_groups(array('username' => $user->username));

                $dashboard_access = !empty(array_filter($user_group, function($arr) {
                    return $arr->dashboard_access == 1 || $arr->special_privilege == 1;
                }));
                $special_access = !empty(array_filter($user_group, function($arr) {
                    return $arr->special_privilege == 1;
                }));

                if($dashboard_access !== true || $special_access !== true) {
                    JSONRES(_WARNING, lang('msg_login_invalid'));
                }

                $user_info = array(
                    'username'          => $user->username,
                    'user_id'           => $user->id,
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'phonenumber'       => $user->phone,
                    // 'address'           => $user->address,
                    'profile_picture'   => $user->profile_picture,
                    'utype'             => $user->utype,
                    // 'app_key'           => $key_values['app_key'],
                    'dashboard_access'  => $dashboard_access,
                    'special_access'    => $special_access
                );

                // Store data to session
                $this->session->set_userdata('user_info', $user_info);
                $addons = array('redirect' => base_url('main/dashboard'));
                return JSONRES(_SUCCESS, sprintf(lang('greetings_login'), $user->name), $addons);
            } else {
                return JSONRES(_ERROR, lang('msg_login_invalid'));
            }
        }

        $this->template->set_template('simple');
        $this->template->write('title', lang('login'), TRUE);
        $this->template->write_view('content', 'dashboard/front/login', array(), true);
        // $this->template->write_view('content', 'dashboard/front/login1', array(), true);
        $this->template->render();
    }

    public function logout() {
        $this->_reset_session();
        redirect();
    }

    protected function _reset_session() 
    {
        $this->session->set_userdata('user_info', null);
        $this->session->set_userdata('is_authed', null);
        unset($_SESSION);
    }

    function load_datamining_result()
    {
        redirect('dashboard');
    }

    function index_barang() {
        $this->acl->validate_read();
        $menu_name = "Barang";
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_general->get_barang($this->input->post());

            $view = $this->load->view('dashboard/barang/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }
        
        LOAD_NAVBAR($menu_name);
        $this->template->write_view('content', 'dashboard/barang/index', $data, TRUE);
        $this->template->render();
    }

    function create_barang()
    {
        $this->acl->validate_create();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            list($iflag, $imsg) = $this->m_general->insert('barang', $this->input->post());

            return JSONRES($iflag, $imsg);
        }

        $view = $this->load->view('dashboard/barang/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update_barang($id)
    {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $where = array('id' => $id);
            list($uflag, $umsg) = $this->m_general->update('barang', $this->input->post(), $where);

            return JSONRES($uflag, $umsg);
        }

        $data['record'] = $this->m_general->get_barang(array('id' => $id));
        $view = $this->load->view('dashboard/barang/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete_barang($id)
    {
        $this->acl->validate_delete();

        $where = array('id' => $id);
        list($dflag, $dmsg) = $this->m_general->delete('barang', $where);

        return JSONRES($dflag, $dmsg);
    }

    function index_perusahaan() {
        $this->acl->validate_read();
        $menu_name = "Perusahaan";
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_general->get_perusahaan($this->input->post());

            $view = $this->load->view('dashboard/perusahaan/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }
        
        LOAD_NAVBAR($menu_name);
        $this->template->write_view('content', 'dashboard/perusahaan/index', $data, TRUE);
        $this->template->render();
    }

    function create_perusahaan()
    {
        $this->acl->validate_create();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            list($iflag, $imsg) = $this->m_general->insert('perusahaan', $this->input->post());

            return JSONRES($iflag, $imsg);
        }

        $view = $this->load->view('dashboard/perusahaan/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update_perusahaan($id)
    {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $where = array('id' => $id);
            list($uflag, $umsg) = $this->m_general->update('perusahaan', $this->input->post(), $where);

            return JSONRES($uflag, $umsg);
        }

        $data['record'] = $this->m_general->get_perusahaan(array('id' => $id));
        $view = $this->load->view('dashboard/perusahaan/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete_perusahaan($id)
    {
        $this->acl->validate_delete();

        $where = array('id' => $id);
        list($dflag, $dmsg) = $this->m_general->delete('perusahaan', $where);

        return JSONRES($dflag, $dmsg);
    }

    function index_transaksi() {
        $this->acl->validate_read();
        $menu_name = "Transaksi";
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_general->get_transaksi($this->input->post());

            $view = $this->load->view('dashboard/transaksi/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }
        
        LOAD_NAVBAR($menu_name);

        // die(json_encode($data));
        $this->template->write_view('content', 'dashboard/transaksi/index', $data, TRUE);
        $this->template->render();
    }

    function create_transaksi()
    {
        $this->acl->validate_create();
        $data = array();
        $data['daftar_barang'] = $this->m_general->dd_barang();
        $data['daftar_perusahaan'] = $this->m_general->dd_perusahaan();


        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $checkBarang = $this->m_general->get(
                'barang',
                array('id' => $this->input->post('id_barang')),
                array('result' => 'row')
            );

            // check if qty is above stok qty
            if ((int)$this->input->post('qty') > (int)$checkBarang->stok) {
                return JSONRES(false, 'Stok barang tidak mencukupi!');
            }

            $postParams = array(
                'kode_transaksi' => "TX" . date("dmYHis"),
                'tx_date'=> date("y-m-d H:i:s"),
                'id_perusahaan' => $this->input->post('id_perusahaan'),
                'id_barang' => $this->input->post('id_barang'),
                'qty' => $this->input->post('qty'),
                'grand_total' => (int)$this->input->post('qty') * (int)$checkBarang->harga
            );

            list($iflag, $imsg) = $this->m_general->insert('transaksi', $postParams);

            if ($iflag) {
                list ($uflag, $umsg) = $this->m_general->update(
                    'barang',
                    array('stok' => (int)$checkBarang->stok - (int)$this->input->post('qty')),
                    array('id' => $this->input->post('id_barang'))
                );

                return JSONRES($uflag, $umsg);
            }
        }

        $view = $this->load->view('dashboard/transaksi/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update_transaksi($id)
    {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $where = array('id' => $id);
            list($uflag, $umsg) = $this->m_general->update('transaksi', $this->input->post(), $where);

            return JSONRES($uflag, $umsg);
        }

        $data['record'] = $this->m_general->get_transaksi(array('id' => $id));
        $view = $this->load->view('dashboard/transaksi/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete_transaksi($id)
    {
        $this->acl->validate_delete();

        $where = array('id' => $id);
        list($dflag, $dmsg) = $this->m_general->delete('transaksi', $where);

        return JSONRES($dflag, $dmsg);
    }
}