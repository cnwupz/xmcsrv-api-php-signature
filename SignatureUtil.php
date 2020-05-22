<?php

class SignatureUtil
{
    private $uuid;
    private $appKey;
    private $appSecret;
    private $timeMillis;
    private $movedCard;

    public function __construct($uuid, $appKey, $appSecret, $timeMillis, $movedCard)
    {
        $this->uuid = $uuid;
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->timeMillis = $timeMillis;
        $this->movedCard = $movedCard;
    }

    public function getEncryptStr()
    {
        $encryptStr = $this->uuid . $this->appKey . $this->appSecret . $this->timeMillis;
        for ($i = 0; $i < strlen($encryptStr); $i++) {
            $encryptByte[] = ord($encryptStr[$i]);
        }
        $changeByte = $this->change($encryptStr, $this->movedCard);
        $mergeByte = $this->mergeByte($encryptByte, $changeByte);
        $asciiString = '';
        for ($i = 0; $i < count($mergeByte); $i++) {
            $asciiString .= chr($mergeByte[$i]);
        }
        return md5($asciiString);
    }

    protected function change($encryptStr, $movedCard)
    {
        $encryptByte = array();
        for ($i = 0; $i < strlen($encryptStr); $i++) {
            $encryptByte[] = ord($encryptStr[$i]);
        }
        $encryptLength = count($encryptByte);

        $temp = '';
        for ($i = 0; $i < $encryptLength; $i++) {
            $temp = (($i % $movedCard) > (($encryptLength - $i) % $movedCard)) ? $encryptByte[$i] : $encryptByte[$encryptLength - ($i + 1)];
            $encryptByte[$i] = $encryptByte[$encryptLength - ($i + 1)];
            $encryptByte[$encryptLength - ($i + 1)] = $temp;
        }
        return $encryptByte;
    }

    protected function mergeByte($encryptByte, $changeByte)
    {
        $encryptLength2 = count($encryptByte) * 2;
        $temp = array();
        for ($i = 0; $i < count($encryptByte); $i++) {
            $temp[$i] = $encryptByte[$i];
            $temp[$encryptLength2 - 1 - $i] = $changeByte[$i];
        }
        return $temp;
    }

}
