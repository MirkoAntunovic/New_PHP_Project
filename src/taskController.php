<?php
use OpenApi\Annotations\Examples;




class taskController
{

	public function __construct(private taskGateway $gateway)
	{

	}



	public function processRequest(string $method, ?string $endpoint): void


	{

		if($endpoint)
		{
			$this->processResourceRequest($method,$endpoint);

		}else
		{

			$this->processCollectionResourceRequest($method);

		}





	}


	private function processResourceRequest(string $method, string $endpoint):void
	{

						switch ($endpoint)
				{


				        case "create-user" :

                        $this->gateway->CreateUser();
                        break;


						case "create-shop" :

					    $this->gateway->CreateShop();
						break;


						case "create-transaction":

						 $this->gateway->CreateTransaction();
						 break;


						 case "create-card":

						 $this->gateway->CreateCard();
						 break;

						 case "all-transaction":

                             $response = $this->gateway->allTransaction();

                             if ($response == null){
                                 echo json_encode (['message'=>'No id in dataabse!']);
                                 break;

                             }echo json_encode($response);
                             break;






						 case "amount-transaction":
                             $response = $this->gateway->amountAndTransaction();
						 echo json_encode($response);
						 break;


						 case "supplement-card":
						 $this->gateway->supplementCard();
						 break;

						 case "login":
						 $this->gateway->login();
						 break;

                         case "examples":

							 $ss=$this->gateway->names;

                             $fnn=$this->gateway->testmoj();

							 foreach($fnn as $q){


								echo nl2br("1-".$q['lastname']."\n");


                             }



							 $o=$this->gateway->data;
                             $fn=$this->gateway->mojtest($o, function ($t){

								return  $t["adress"] === "zagreb";
                             }



								 );


							foreach( $fn as $r)
                             {
                                 echo ("2-".$r['name']."\n");
								


                             }





							 break;

				}

	}

	private function processCollectionResourceRequest(string $method): void
	    {




		}






}




?>