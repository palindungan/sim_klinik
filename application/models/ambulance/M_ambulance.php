<?php
class M_ambulance extends CI_Model
{
    private $_table = 'ambulance';

    function getAmbulance()
    {
        return $this->db->get($this->_table);
    }
}
