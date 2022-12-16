<?php

class taskGateway
{
	private PDO $conn;

	public function __construct (Database $database)
	{
		$this->conn=$database->getConnection();
	}

	//Kreiranje usera
	public function CreateUser()
    {
		$data=json_decode(file_get_contents("php://input"));



		if($data->id==''){

		echo json_encode (['status'=>'failed','msg'=>'Users id didnt provided!']);
		}elseif($data->date_entered==''){
					echo json_encode (['status'=>'failed','msg'=>'Users date_entered did not provided!']);

		}elseif($data->shop_id==''){
					echo json_encode (['status'=>'failed','msg'=>'Users shop_id did not provided!']);
		}elseif($data->username==''){
					echo json_encode (['status'=>'failed','msg'=>'Users username didnt provided!']);
		}elseif($data->password==''){
					echo json_encode (['status'=>'failed','msg'=>'Users password didnt provided!']);
		}elseif($data->type==''){
					echo json_encode (['status'=>'failed','msg'=>'Users type didnt provided!']);
		}elseif($data->status==''){
					echo json_encode (['status'=>'failed','msg'=>'Users status didnt provided!']);
		}else
		{
			$query="INSERT INTO users(id,date_entered,shop_id,username,password,type,status)";
            $query.="VALUES('$data->id','$data->date_entered','$data->shop_id','$data->username','$data->password','$data->type','$data->status')";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
        }

        if($stmt)
        {

	    echo json_encode(['status'=>'success', 'message'=>'User successfuly added']);

        }else
	    {
		echo json_encode(['status'=>'Failed', 'message'=>'User isnt added']);

        }

    }

	//Kreiranje Shopa
	public function CreateShop()
	{
		$data=json_decode(file_get_contents("php://input"));
		if($data->id==''){

		echo json_encode (['status'=>'failed','msg'=>'Shop id did not provided!']);
		}elseif($data->date_entered==''){
					echo json_encode (['status'=>'failed','msg'=>'Shop date_entered did not provided!']);

		}elseif($data->name==''){
					echo json_encode (['status'=>'failed','msg'=>'Shop name did not provided!']);
		}elseif($data->email==''){
					echo json_encode (['status'=>'failed','msg'=>'Shop email did not provided!']);
		}elseif($data->status==''){
					echo json_encode (['status'=>'failed','msg'=>'Shop status did not provided!']);
		}else
		{
			$query="INSERT INTO shops(id,date_entered,name,email,status)";
            $query.="VALUES('$data->id','$data->date_entered','$data->name','$data->email','$data->status')";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
        }

        if($stmt)
        {

	    echo json_encode(['status'=>'success', 'message'=>'Shop added']);

        }else
	    {
		echo json_encode(['status'=>'Failed', 'message'=>'Shop did not added']);

        }

	}
	//Kreiranje transakcije
	public function CreateTransaction()
	{
		$data=json_decode(file_get_contents("php://input"));
		if($data->id=='')
		{
		echo json_encode (['status'=>'failed','msg'=>'Transaction id did not provided!']);
		}elseif($data->date_entered=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction date_entered did not provided!']);
		}elseif($data->shop_id=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction shop_id did not provided!']);
		}elseif($data->barcode=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction barcode did not provided!']);
		}elseif($data->type=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction type did not provided!']);
		}elseif($data->amount=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction amount did not provided!']);
		}elseif($data->start_amount=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction start_amount did not provided!']);
		}elseif($data->end_amount=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction end_amount did not provided!']);
		}elseif($data->comment=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Transaction comment did not provided!']);
		}else
		{
			$query="INSERT INTO transaction(id,date_entered,shop_id,barcode,type,amount,start_amount,end_amount,comment)";
            $query.="VALUES('$data->id','$data->date_entered','$data->shop_id','$data->barcode','$data->type','$data->amount','$data->start_amount','$data->end_amount','$data->comment')";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
        }

        if($stmt)
        {

	    echo json_encode(['status'=>'success', 'message'=>'Transaction added']);

        }else
	    {
		echo json_encode(['status'=>'Failed', 'message'=>'Transaction did not added']);

        }

	}

	//Kreiranje kartice
	public function CreateCard()
	{
		$data=json_decode(file_get_contents("php://input"));
		if($data->id=='')
		{
		echo json_encode (['status'=>'failed','msg'=>'Card id did not provided!']);
		}elseif($data->date_entered=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Card date_entered did not provided!']);
		}elseif($data->barcode=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Card barcode did not provided!']);
		}elseif($data->amount=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Card amount did not provided!']);
		}elseif($data->last_payment=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Card last_payment did not provided!']);
		}elseif($data->status=='')
		{
					echo json_encode (['status'=>'failed','msg'=>'Card status did not provided!']);
		}else
		{
			$query="INSERT INTO cards(id,date_entered,barcode,amount,last_payment,status)";
            $query.="VALUES('$data->id','$data->date_entered','$data->barcode','$data->amount','$data->last_payment','$data->status')";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
        }

        if($stmt)
        {

	    echo json_encode(['status'=>'success', 'message'=>'Card added']);

        }else
	    {
		echo json_encode(['status'=>'Failed', 'message'=>'Card did not added']);

        }

	}

	//Pregled svih transakcija za shop
	public function allTransaction():array
	{

		  $query="SELECT * FROM `transaction` WHERE `shop_id`IN(SELECT `shop_id` from transaction)";
          $response=array();
          $stmt = $this->conn->prepare($query);

          $stmt->execute();
          $response=array();

        if($stmt)
		{
	      $i=0;
	      $data=[];

	    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
		  $response[$i]['id']=$row['id'];
		  $response[$i]['date_entered']=$row['date_entered'];
		  $response[$i]['shop_id']=$row['shop_id'];
		  $response[$i]['barcode']=$row['barcode'];
		  $response[$i]['amount']=$row['amount'];
		  $response[$i]['start_amount']=$row['start_amount'];
		  $response[$i]['end_amount']=$row['end_amount'];
		  $response[$i]['end_amount']=$row['end_amount'];

		  $data=$response;
		  $i++;
	    }

	    }
	return $data;

	}

	//Provjera stanja i svih transakcija na kartici (putem barkoda)
	public function amountAndTransaction() : array
	{


		  $query="SELECT cards.amount,transaction.barcode FROM `transaction` inner JOIN cards on transaction.barcode=cards.barcode";
          $response=array();
          $stmt = $this->conn->prepare($query);

          $stmt->execute();
          $response=array();

        if($stmt)
		{
	      $i=0;
	      $data=[];

	    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
		  $response[$i]['amount']=$row['amount'];
		  $response[$i]['barcode']=$row['barcode'];


		  $data=$response;
		  $i++;
	    }

	    }
	return $data;

	}

	//Nadopuna kartice
	public function supplementCard()
	{
		$data=json_decode(file_get_contents("php://input"));



		if($data->amount==''){

		echo json_encode (['status'=>'failed','msg'=>'Amount did not supplement to card!']);
		}else
		{
			$query="UPDATE cards
            SET amount='$data->amount' where id=(select MAX(id) from cards)";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
        }

        if($stmt)
        {

	    echo json_encode(['status'=>'success', 'message'=>'Amount added']);

        }else
	    {
		echo json_encode(['status'=>'Failed', 'message'=>'Amount did not added']);

        }


	}

	//login
	public function login ()
	{

		 $query="SELECT username,password FROM `users`";
          $response=array();
          $stmt = $this->conn->prepare($query);

          $stmt->execute();
          $response=array();

        if($stmt)
		{
	      $i=0;
	      $data=[];

	    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
		  $response[$i]['username']=$row['username'];
		  $response[$i]['password']=$row['password'];
		  $data=json_decode(file_get_contents("php://input"));



		  $i++;

		}
         $y = false;
		 $data=json_decode(file_get_contents("php://input"));
		if($data->username=='')
		{
	  echo json_encode(['status'=>'failed', 'message'=>'Please, enter username!']);

		}
		if($data->password=='')
		{
	  echo json_encode(['status'=>'failed', 'message'=>'Please, enter password!']);

		}


		 for($i=0; $i<count($response); $i++)
		{

			  if($response[$i]['username'] == $data->username && $response[$i]['password'] == $data->password )
		    {
						 $y=true;

		    }






		}
		if ($y==true)
		    echo json_encode(['status'=>'success', 'message'=>'You are successfully logged!']);
	    else
	        echo json_encode(['status'=>'failed', 'message'=>'You did not successfully logged!']);







		}

	}




}



?>

