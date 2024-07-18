<?php

/**
 * This Class will flip IP Remote Address
 */
Class FlipOriginIp {
    private $originIp;
    public $flippedIp;
    public function __construct()
    {
        $this->originIp = $_SERVER['REMOTE_ADDR'];
        list($a,$b,$c,$d) = explode($this->originIp, ".");
        $this->flippedIp = $d.".".$c.".".$b.".".$a;
        $this->db = new Db();
        $this->storeInDb();
    }

    private function storeInDb()
    {
        $this->db->insert->into('flippedIp')->value(['flippedIp'=>$this->flippedIp]);
    }
}
?>