<?php

class Process{
    private $itemsTable = "astro_verify";      
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }
    function create_user(){
          
        $tablename='astro_user';
    	$stmt = $this->conn->prepare("
    		INSERT INTO ".$tablename."(`first_name`, `middle_name`, `last_name`, `gender`, `mobile_no`,`mail_id`,`created_on`)
    		VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $this->fname, $this->mname, $this->lname, $this->gender, $this->mobile, $this->email, $this->created);
        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->mname = htmlspecialchars(strip_tags($this->mname));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
    	$this->mobile = htmlspecialchars(strip_tags($this->mobile));
    	$this->email = htmlspecialchars(strip_tags($this->email));
        $this->created = htmlspecialchars(strip_tags($this->created));
        if($stmt->execute()){
    		return true;
    	}
    
    	return false;		 
    }
    /**
     * Profile update
     */
    function update_profile()
    {
        $tablename='astro_user';
    	$stmt = $this->conn->prepare("
    		update ".$tablename."SET `first_name`=?,`middle_name`=?',`last_name`=?,`gender`=?,`mother_name`=?,`father_name`=?,`language`=?,`city_id`=?,`state_id`=?,`pincode`=?,`nationality`=?,`birth_date`=?,`birth_time`=?,`birth_place`=?,`religion`=? WHERE id=?");
        $stmt->bind_param("sssssssiiisssisi", $this->fname, $this->mname, $this->lname, $this->gender,$this->mother_name,$this->father_name,$this->lang,$this->city,$this->state,$this->pincode,$this->nationality,$this->birth_date,$this->birthe_time,$this->birth_place,$this->religion,$this->id);
        $this->fname = htmlspecialchars(strip_tags($this->first_name)); 
        $this->lname = htmlspecialchars(strip_tags($this->last_name));
        $this->mname = htmlspecialchars(strip_tags($this->middle_name));
        $this->gender = htmlspecialchars(strip_tags($this->gender)); 
        $this->mother_name = htmlspecialchars(strip_tags($this->mother_name)); 
        $this->father_name = htmlspecialchars(strip_tags($this->father_name)); 
        $this->lang = htmlspecialchars(strip_tags($this->lang)); 
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->pincode = htmlspecialchars(strip_tags($this->pincode)); 
        $this->nationality = htmlspecialchars(strip_tags($this->nationality)); 
        $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
        $this->birthe_time = htmlspecialchars(strip_tags($this->birthe_time)); 
        $this->birth_place = htmlspecialchars(strip_tags($this->birth_place)); 
        $this->religion = htmlspecialchars(strip_tags($this->religion));
        $this->id = htmlspecialchars(strip_tags($this->id)); 
        if($stmt->execute()){
    		return true;
    	}
    
    	return false;
    }
    /**
     * @param mobile/email string
     */
    function send_otp()
    {
        $sql="INSERT INTO ".$this->itemsTable."(`source`, `otp`, `created_on`)
        VALUES(?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sis", $this->name, $this->otp,$this->created);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->otp = htmlspecialchars(strip_tags($this->otp));
        $this->created = htmlspecialchars(strip_tags($this->created));
       
        if($stmt->execute()){
            if($this->source_type=='email')
            {
                return true;
                // $this->sendMail($this->name,$this->otp);
            }
            else
            {
                return true;
            }
        }
    
        return false;		 
    }
    /**
     * @param email string
     */
    // function sendMail($email,$otp)
    // {
    //     // Import PHPMailer classes into the global namespace 
    //     use PHPMailer\PHPMailer\PHPMailer; 
    //     use PHPMailer\PHPMailer\SMTP; 
    //     use PHPMailer\PHPMailer\Exception; 
        
    //     // Include library files 
    //     require '../Library/PHPMailer/Exception.php'; 
    //     require '../Library/PHPMailer/PHPMailer.php'; 
    //     require '../Library/PHPMailer/SMTP.php'; 
        
    //     // Create an instance; Pass `true` to enable exceptions 
    //     $mail = new PHPMailer; 
        
    //     // Server settings 
    //     //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
    //     $mail->isSMTP();                            // Set mailer to use SMTP 
    //     $mail->Host = 'smtp.example.com';           // Specify main and backup SMTP servers 
    //     $mail->SMTPAuth = true;                     // Enable SMTP authentication 
    //     $mail->Username = 'user@example.com';       // SMTP username 
    //     $mail->Password = 'email_password';         // SMTP password 
    //     $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
    //     $mail->Port = 465;                          // TCP port to connect to 
        
    //     // Sender info 
    //     $mail->setFrom('shweta.gupta249@gmail.com', 'Shweta Gupta'); 
        
    //     // Add a recipient 
    //     $mail->addAddress('recipient@example.com'); 
        
    //     //$mail->addCC('cc@example.com'); 
    //     //$mail->addBCC('bcc@example.com'); 
        
    //     // Set email format to HTML 
    //     $mail->isHTML(true); 
        
    //     // Mail subject 
    //     $mail->Subject = 'Email from Localhost by CodexWorld'; 
        
    //     // Mail body content 
    //     $bodyContent = '<h1>How to Send Email from Localhost using PHP by CodexWorld</h1>'; 
    //     $bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>CodexWorld</b></p>'; 
    //     $mail->Body    = $bodyContent; 
        
    //     // Send email 
    //     if(!$mail->send()) 
    //     { 
    //         // echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    //     } else 
    //     { 
    //         // echo 'Message has been sent.'; 
    //     }  
    // } 

    /**
     * @param Mobile/Email string
     * @param otp int
     */
    function verify_otp()
    {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE source = ? and otp = ? ");
        $stmt->bind_param("si", $this->name,$this->otp);
        $stmt->execute();			
        $result = $stmt->get_result();	
        // print($result);exit;	
        if($result>0){
            
            return true;
        }
        
        return false;
    }
    function login()
    {
        
    }
}
?>