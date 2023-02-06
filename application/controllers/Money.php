<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Money extends CI_Controller
{
    public function index()
    {
        $this->show_chances();
        $this->show_money();
        $this->show_messages();
        $this->load->view('money/index');
    }
    public function reset()
    {   
        $this->session->set_userdata('chances', 10);
        $this->session->set_userdata('money', 500);
        $this->session->set_userdata('messages', array("<p>[ {$this->show_datetime()} ] Welcome to Money Button Game, risk taker! All you need to do is to push buttons to try your luck. You have free 10 chances with initial money 500. Choose wisely and good luck!</p>"));
        redirect('/');
    }
    public function bet()
    {
        $bets = array(
            "low" => rand(-25, 100),
            "moderate" => rand(-100, 100),
            "high" => rand(-500, 2500),
            "severe" => rand(-3000, 5000)
        );
        $risk = $this->input->post('bet');
        $bet = $bets[$risk];
        if($this->session->userdata('money') <= 0 || $this->session->userdata('chances') <=  0)
        {
            $messages = $this->session->userdata('messages');
            $messages[] = "Game Over!";
            $this->session->set_userdata('messages', $messages);
        }
        else
        {
            $chance = $this->calculate_chances();
            $money = $this->calculate_money($bet);
            $this->compose_message($risk, $bet, $chance, $money);
        }
        redirect('/');
    }

    public function calculate_chances()
    {
        $chances = $this->session->userdata('chances');
        $chances -= 1;
        $remainChance = $chances;
        $this->session->set_userdata('chances', $remainChance);
        return $remainChance;
    }

    public function calculate_money($bet)
    {
        $money = $this->session->userdata('money');
        $remainMoney = $money + $bet;
        $this->session->set_userdata('money', $remainMoney);
        return $remainMoney;
    }

    public function compose_message($risk, $bet, $chance, $money)
    {
        $datetime = $this->show_datetime();
        if($bet > 0)
        {
            $class="success";
        }
        else
        {
            $class="danger";
        }

        $message = "<p class='$class'>[$datetime] You pushed $risk. Value is $bet. Your current money now is $money with $chance chance(s) left.</p>";
        $messages = $this->session->userdata('messages');
        $messages[] = $message;
        $this->session->set_userdata('messages', $messages);
    }

    public function show_chances()
    {
        if(!$this->session->userdata('chances') && $this->session->userdata('chances') !== 0)
        {
            $this->session->set_userdata('chances', 10);
        }
        $chances = $this->session->userdata('chances');


        return $chances;
    }
    
    public function show_money()
    {
        if(!$this->session->userdata('money'))
        {
            $this->session->set_userdata('money', 500);
        }
        $money = $this->session->userdata('money');

        return $money;
    }

    public function show_messages()
    {
        if(!$this->session->userdata('messages'))
        {
            $this->session->set_userdata('messages', array("<p>[ {$this->show_datetime()} ] Welcome to Money Button Game, risk taker! All you need to do is to push buttons to try your luck. You have free 10 chances with initial money 500. Choose wisely and good luck!</p>"));
        }
        $messages = $this->session->userdata('messages');

        return $messages;
    }

    public function show_datetime()
    {
        $datetime = new DateTime('Asia/Manila');
        $datetime = $datetime->format('m/d/Y H:iA');
        return $datetime;
    }
}
?>