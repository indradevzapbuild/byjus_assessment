<?php
/**
 *
 * CollegeModel extends the DbConfig PDO class to interact with the auth DB table
 */
class CollegeModel extends DbConfig
{

    /**
     * @var array available columns in the DB
     */
    protected $_columns = [];

    /**
     * Initialises the $_db config variable
     */
    public function __construct()
    {
        parent::__construct();
        $this->collegeTable = 'colleges';
    }
    public function get() {
        $sql = "SELECT * FROM $this->collegeTable";
        return $result = $this->select($sql);
    }
    public function create($data) {
          $sql = "INSERT INTO $this->collegeTable (college_name,college_location, url, created_at) VALUES (:college_name, :college_location, :url, :created_at);";
          $placeholders = [":college_name"=>$data['college_name'], ":college_location"=>$data['college_location'],":url"=>$data['url'],':created_at'=>date("Y-m-d H:i:s")];
         $result = $this->insert($sql, $placeholders);
        return $result;
    }
      public function edit($data,$id) {
          $sql = "UPDATE $this->collegeTable SET college_name=:college_name,college_location=:college_location, url=:url WHERE id=:id";
          $placeholders = [":college_name"=>$data['college_name'], ":college_location"=>$data['college_location'],":url"=>$data['url'],":id"=>$id];
         $result = $this->update($sql, $placeholders);
        return $result;
    }
    public function updateDeadLink() {
           $sql = "SELECT * FROM $this->collegeTable";
            $result = $this->select($sql);
            foreach ($result as $key => $value) {
               $check_url_status = $this->checkURL($value['url']);
                if ($check_url_status != '200'){
                   $value['url'] = $this->getHomeURL($value['url']);
                   $this->edit($value,$value['id']);
                }
            }
    }
     public function createCSV() {
           $sql = "SELECT * FROM $this->collegeTable";
            $result = $this->select($sql);
        $list=array();
        $list['tableheading'] =array('College Name','URL');
        $fichier = 'collegeLinks.xls';
        header( "Content-Type: text/csv;charset=utf-8" );
        header( "Content-Disposition: attachment;filename=\"$fichier\"" );
        header("Pragma: no-cache");
        header("Expires: 0");
        $fp= fopen('php://output', 'w');
        fputcsv($fp,$list['tableheading'] );
        foreach($result AS $tabledata) {              
            $data['list']=array($tabledata['college_name'],$tabledata['url']);
            fputcsv($fp, $data['list']);
        }
        fclose($fp);
        exit();
    }
    private function checkURL($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    $headers = curl_getinfo($ch);
    curl_close($ch);

    return $headers['http_code'];
   }
    private function getHomeURL($url) {
      $parsed = parse_url($url);
       return $parsed['scheme']. '://'. $parsed['host'];
    }
} 