<?php
class BasicInfoModel extends DbConfig
{

    /**
     * @var array available columns in the DB
     */
    protected $_columns = [];

    /**
     * @var encription and decription key
     */
    private $key = "iamverystrong";

    /**
     * Initialises the $_db config variable
     */
    public function __construct()
    {
        parent::__construct();
        $this->basicTable = 'basic_info';
    }
    public function encrypt( $plaintext, $meta = '' ) {
        // Generate valid key
        $key = hash_pbkdf2( 'sha256', $this->key, '', 10000, 0, true );
        // Serialize metadata
        $meta = serialize($meta);
        // Derive two subkeys from the original key
        $mac_key = hash_hmac( 'sha256', 'mac', $key, true );
        $enc_key = hash_hmac( 'sha256', 'enc', $key, true );
        $enc_key = substr( $enc_key, 0, 32 );
        // Derive a "synthetic IV" from the nonce, plaintext and metadata
        $temp = $nonce = ( 16 > 0 ? mcrypt_create_iv( 16 ) : "" );
        $temp .= hash_hmac( 'sha256', $plaintext, $mac_key, true );
        $temp .= hash_hmac( 'sha256', $meta, $mac_key, true );
        $mac = hash_hmac( 'sha256', $temp, $mac_key, true );
        $siv = substr( $mac, 0, 16 );
        // Encrypt the message
        $enc = mcrypt_encrypt( 'rijndael-128', $enc_key, $plaintext, 'ctr', $siv );
        return base64_encode( $siv . $nonce . $enc );
  }
  public function decrypt( $ciphertext, $meta = '' ) {
        // Generate valid key
        $key = hash_pbkdf2( 'sha256', $this->key, '', 10000, 0, true );
        // Serialize metadata
        $meta = serialize($meta);
        // Derive two subkeys from the original key
        $mac_key = hash_hmac( 'sha256', 'mac', $key, true );
        $enc_key = hash_hmac( 'sha256', 'enc', $key, true );
        $enc_key = substr( $enc_key, 0, 32 );
        // Unpack MAC, nonce and encrypted message from the ciphertext
        $enc = base64_decode( $ciphertext );
        $siv = substr( $enc, 0, 16 );
        $nonce = substr( $enc, 16, 16 );
        $enc = substr( $enc, 16 + 16 );
        // Decrypt message
        $plaintext = mcrypt_decrypt( 'rijndael-128', $enc_key, $enc, 'ctr', $siv );
        // Verify MAC, return null if message is invalid
        $temp = $nonce;
        $temp .= hash_hmac( 'sha256', $plaintext, $mac_key, true );
        $temp .= hash_hmac( 'sha256', $meta, $mac_key, true );
        $mac = hash_hmac( 'sha256', $temp, $mac_key, true );
        if ( $siv !== substr( $mac, 0, 16 ) ) return null;
          return $plaintext;
    }

    public function create($data) {
          $sql = "INSERT INTO $this->basicTable (first_name,last_name, email, created_at) VALUES (:first_name, :last_name, :email, :created_at);";
          $placeholders = [":first_name"=>$this->encrypt($data['first_name']), ":last_name"=>$this->encrypt($data['last_name']),":email"=>$this->encrypt($data['email']),':created_at'=>date("Y-m-d H:i:s")];
         $result = $this->insert($sql, $placeholders);
        return $result;
    }
    public function get(){
        $sql = "SELECT * FROM $this->basicTable";
        $result = $this->select($sql);
        $data = [];
        foreach ($result as $key => $row) {
          $row['first_name'] = $this->decrypt($row['first_name']);
          $row['last_name'] = $this->decrypt($row['last_name']);
          $row['email'] = $this->decrypt($row['email']);
          $data[] = $row;
        }
        return $data;
    }
} 