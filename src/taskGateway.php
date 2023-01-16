<?php
use OpenApi\Annotations as OA;
use OpenApi\Annotations\Response;

/**
 * @OA\Info(title="Search API", version="1.0.0")
 */
class taskGateway
{
	private PDO $conn;
	public $idd;

	public function __construct (Database $database)
	{
		$this->conn=$database->getConnection();
	}


    /**
     *    @OA\Post(
     *   path="/start/create-user",
     *
     * summary="Create a new user.", tags={"Post"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="application/json",
     *        @OA\Schema(
     *            @OA\Property(
     *                property="id",
     *                type="integer",
     *                 example="4",
     *            ),
     *            @OA\Property(
     *                property="date_entered",
     *                type="varchar",
     *                 example="11",
     *            ),
     *            @OA\Property(
     *                property="shop_id",
     *                type="integer",
     *                example="1",
     *            ),
     *
     *              @OA\Property(
     *                property="username",
     *                type="varchar",
     *                example="mirko43",
     *            ),
     *              @OA\Property(
     *                property="password",
     *                type="varchar",
     *                example="Test0011",
     *            ),
     *            @OA\Property(
     *                property="type",
     *                type="varchar",
     *                example="test",
     *            ),
     *              @OA\Property(
     *                property="status",
     *                type="varchar",
     *                example="activ",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */



	//Kreiranje usera
	public function CreateUser()
    {
		$data=json_decode(file_get_contents("php://input"));
		$id=$data->id;
		$date_entered=$data->date_entered;
		$shop_id=$data->shop_id;
		$username=$data->username;
		$password=$data->password;
		$type=$data->type;
		$status=$data->status;

		if($data->id==''){

		echo json_encode (['status'=>'failed','msg'=>'Users id didnt provided!']);
		}elseif($data->date_entered==''){
					echo json_encode (['status'=>'failed','msg'=>'Users date_entered did not provided!']);

		}elseif($data->shop_id==''){
					echo json_encode (['status'=>'failed','msg'=>'Users shop_id didnt provided!']);
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
			$query="INSERT INTO users
                    SET
                      id = :id,
                      date_entered = :date_entered,
                      shop_id=:shop_id,
                      username=:username,
                      password=:password,
                      type=:type,status=:status";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id",$id);
            $stmt->bindValue(":date_entered",$date_entered);
			$stmt->bindValue(":shop_id",$shop_id);
            $stmt->bindValue(":username",$username);
            $stmt->bindValue(":password",$password);
            $stmt->bindValue(":type",$type);
            $stmt->bindValue(":status",$status);
            // ovo je test


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


	/**
     *    @OA\Post(
     *   path="/start/create-shop",
     *
     * summary="Create a shop.", tags={"Post"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="application/json",
     *        @OA\Schema(
     *
     *           @OA\Property(
     *                property="id",
     *                type="integer",
     *                example="1",
     *            ),
     *
     *
     *            @OA\Property(
     *                property="date_entered",
     *                type="varchar",
     *                 example="11",
     *            ),
     *
     *            @OA\Property(
     *                property="name",
     *                type="string",
     *                 example="nameofshop",
     *
     *            ),
     *
     *
     *              @OA\Property(
     *                property="email",
     *                type="varchar",
     *                example="mirko43@test.com",
     *            ),
     *
     *
     *
     *              @OA\Property(
     *                property="status",
     *                type="varchar",
     *                example="activ",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */


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

    /**
     *    @OA\Post(
     *   path="/start/create-transaction",
     *
     * summary="Create a transaction.", tags={"Post"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="application/json",
     *        @OA\Schema(
     *            @OA\Property(
     *                property="id",
     *                type="integer",
     *                 example="4",
     *            ),
     *            @OA\Property(
     *                property="date_entered",
     *                type="varchar",
     *                 example="11",
     *            ),
     *            @OA\Property(
     *                property="shop_id",
     *                type="integer",
     *                example="1",
     *            ),
     *
     *              @OA\Property(
     *                property="barcode",
     *                type="integer",
     *                example="1216361346",
     *            ),
     *
     *            @OA\Property(
     *                property="type",
     *                type="varchar",
     *                example="test",
     *            ),
     *              @OA\Property(
     *                property="amount",
     *                type="integer",
     *                example="255",
     *            ),
     *             @OA\Property(
     *                property="start_amount",
     *                type="integer",
     *                example="10",
     *            ),
     *            @OA\Property(
     *                property="end_amount",
     *                type="integer",
     *                example="2000",
     *            ),
     *            @OA\Property(
     *                property="comment",
     *                type="string",
     *                example="This is comment",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */



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



    /**
     *    @OA\Post(
     *   path="/start/create-card",
     *
     * summary="Create a card.", tags={"Post"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="application/json",
     *        @OA\Schema(
     *            @OA\Property(
     *                property="id",
     *                type="integer",
     *                 example="4",
     *            ),
     *            @OA\Property(
     *                property="date_entered",
     *                type="varchar",
     *                 example="11",
     *            ),
     *            @OA\Property(
     *                property="barcode",
     *                type="integer",
     *                example="322423423",
     *            ),
     *
     *              @OA\Property(
     *                property="amount",
     *                type="integer",
     *                example="500",
     *            ),
     *
     *            @OA\Property(
     *                property="last_payment",
     *                type="varchar",
     *                example="1.1",
     *            ),
     *              @OA\Property(
     *                property="amount",
     *                type="integer",
     *                example="255",
     *            ),
     *             @OA\Property(
     *                property="status",
     *                type="type",
     *                example="test",
     *            ),
     *
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */

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


    /**
     *    @OA\Post(
     *   path="/start/all-transaction",
     *   summary="Get all transaction",
     *   tags={"Post"},
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *          mediaType="application/json",
     *       @OA\Schema(required={"id"},
     *       @OA\Property(property="id", type="integer"))
     *
     *         )
     *
     * ),
     *
     *
     *   @OA\Response(response="200", description="An example resource"),
     *   @OA\Response(response="404", description="Not Found"),
     * )
     *
     */






	//Pregled svih transakcija za shop
    public function allTransaction()
	{
		$date=json_decode(file_get_contents("php://input"));
		$id=$date->id;


        $query="SELECT * FROM `transaction` WHERE `shop_id`IN(SELECT `shop_id` from transaction) and id=:id";
        $response=array();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id",$id);

        $stmt->execute();
        $response=array();

        if($stmt)
        {
            $i=0;
            $data=array();

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
        if (!empty($data))
            return $data;
        else
            return null;



	}



    /**
     * @OA\Get(
     * path="/start/amount-transaction",
     * summary="Get amount for transaction",
     * tags={"Get"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */

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


    /**
     *    @OA\Post(
     *   path="/start/supplement-card",
     *   summary="Supplement the card",
     *   tags={"Post"},
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *          mediaType="application/json",
     *       @OA\Schema(required={"amount"},
     *       @OA\Property(property="amount", type="integer"))
     *
     *         )
     *
     * ),
     *
     *
     *   @OA\Response(response="200", description="An example resource"),
     *   @OA\Response(response="404", description="Not Found"),
     * )
     *
     */

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


    /**
     *    @OA\Post(
     *   path="/start/login",
     *   summary="Login",
     *   tags={"Post"},
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *          mediaType="application/json",
     *       @OA\Schema(required={"username","password"},
     *       @OA\Property(property="username", type="string"),
     *       @OA\Property(property="password", type="string"),
     * ),
     *
     *         ),
     *
     * ),
     *
     *
     *   @OA\Response(response="200", description="An example resource"),
     *   @OA\Response(response="404", description="Not Found"),
     * )
     *
     */


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




     public static $names =[
           [
            "name" =>"mirko",
            "lastname" =>"antunovic",
            "yearOfBorn"=>"1234",
             "status"=>"active"
           ],

            [
            "name" =>"mate",
            "lastname" =>"pavic",
             "yearOfBorn"=>"12345",
             "status"=>"deactive"
           ],

              [
            "name" =>"ivan",
            "lastname" =>"ivic",
             "yearOfBorn"=>"1234",

             "status"=>"active"
           ],
              [
            "name" =>"ivan",
            "lastname" =>"pravdic",
             "yearOfBorn"=>"1234",
             "status"=>"deactive"
           ],

            ];

     public  $data =[
          [
           "name" =>"mirko",
           "adress" =>"livno"

          ],

           [
           "name" =>"mate",
           "adress" =>"zagreb"

          ],

             [
           "name" =>"ivan",
           "adress" =>"split"

          ],
          [
           "name" =>"ljubo",
           "adress" =>"zagreb"

          ],
             [
           "name" =>"ivan",
           "adress" =>"mostar"
          ],

           ];


     public static function test($activ, $kay, $value){

         foreach($activ as $all){
             if ($all[$kay]==$value){

                 $rez[]=$all;
             }

         }

         return $rez;





        }

    public function mojtest($jj,$funi)
    {

        foreach($jj as $w){

            if ($funi($w))

                $p[]=$w;

        }


         return $p;
     }


    public function testmoj(){
        

        $aa=taskGateway::$names;

        $ss=taskGateway::test($aa, "status","deactive");

        return $ss;
    }

}



?>

