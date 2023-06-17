<?php

class Process{
    private $itemsTable = "astro_verify";      
    // public $id;
    // public $name;
    // public $description;
    // public $price;
    // public $category_id;   
    // public $created; 
	// public $modified; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }
    // function create(){
            
    // 	$stmt = $this->conn->prepare("
    // 		INSERT INTO ".$this->itemsTable."(`name`, `description`, `price`, `category_id`, `created`)
    // 		VALUES(?,?,?,?,?)");
        
    // 	$this->name = htmlspecialchars(strip_tags($this->name));
    // 	$this->description = htmlspecialchars(strip_tags($this->description));
    // 	$this->price = htmlspecialchars(strip_tags($this->price));
    // 	$this->category_id = htmlspecialchars(strip_tags($this->category_id));
    // 	$this->created = htmlspecialchars(strip_tags($this->created));
        
        
    // 	$stmt->bind_param("ssiis", $this->name, $this->description, $this->price, $this->category_id, $this->created);
        
    // 	if($stmt->execute()){
    // 		return true;
    // 	}
    
    // 	return false;		 
    // }
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
}
?>