<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller
{
    public function form_inscription()
    {
        $this->load->view('utilisateur/form_inscription');
    }

    public function form_authentification()
    {
        $this->load->view('utilisateur/form_authentification');
    }

    public function nouvel_utilisateur()
    {
        $this->form_validation->set_rules('nomcomplet','nom complet','required',array(
            'required'=>'* veuillez fournir le %s'));
        $this->form_validation->set_rules('email','e-mail','required|valid_email',array(
            'required'=>'* veuillez fournir le %s',
            'valid_email'=>'* veuillez fournir un %s valide'));
        $this->form_validation->set_rules(
            'login','nom d\'utilisateur','required|is_unique[utilisateur.login]|min_length[4]|max_length[15]|alpha',array(
            'required'=>'* veuillez fournir le %s',
            'is_unique'=>'* %s déja utilisé',
            'min_length'=>'* %s trop court',
            'max_length'=>'* %s trop long',
            'alpha'=>'* %s invalide'));
        $this->form_validation->set_rules('mdp','mot de passe','required|min_length[8]',array(
            'required'=>'* veuillez fournir un %s',
            'min_length'=>'* %s trop court'));
        $this->form_validation->set_rules('mdpconf','confirmation mot de passe','required|matches[mdp]',array(
            'required'=>'* veuillez confirmer le mot de passe',
            'matches'=>'* mots de passe non-identiques'));

        if($this->form_validation->run() == TRUE)
         {  
            $nomcomplet = $this->input->post('nomcomplet');
            $email = $this->input->post('email');
            $login = $this->input->post('login');
            $mdp = $this->input->post('mdp');
            $mdpconf = $this->input->post('mdpconf');

            $data = array(
                'nomcomplet' => $nomcomplet,
                'email' => $email,
                'login' => $login,
                'mdp' => $mdp,
                'etat' => FALSE
            );

            $this->load->model('UtilisateurModel');
            $this->UtilisateurModel->creer_utilisateur($data);
        
            $this->load->view('utilisateur/inscription_success');

           }
         else
         {
            $this->load->view('utilisateur/form_inscription');
         }
    }

    public function connexion()
    {
        $login = $this->input->post('login');
        $mdp = $this->input->post('mdp');
        $d = array(
            'login' => $login,
            'mdp' => $mdp
        );

        $this->load->model('UtilisateurModel');
        $r = $this->UtilisateurModel->check_authentification($d);

        if(count($r) > 0)
        {
            $user = $r[0];
            $d = array(
                'id' => $user->id,
                'nomcomplet' => $user->nomcomplet,
                'is_connected' => true
            );
            $this->session->set_userdata($d);
            redirect('utilisateur/accueil');
        }
        else
        {
            $d = array(
                'error_login' => 'Login ou mot de passe incorrect'
            );
            $this->session->set_flashdata($d);
            $this->form_authentification();
        }
    }

    public function accueil()
    {
        if($this->session->is_connected)
        {
            $this->load->view('utilisateur/accueil');
        }
        else
        {
            redirect();
        }
    }

    public function deconnexion()
    {
        $this->session->unset_userdata('is_connected');
        redirect();
    }
}