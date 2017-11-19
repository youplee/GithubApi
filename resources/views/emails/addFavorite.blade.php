<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<title>Votre comparaison d'assurances</title>
		<style>

	        @media only screen and (max-width: 724px){
			 	.logo{
			 		max-width: 304px !important;
			 	}
			 	h5{
			 		font-size: 24px !important;
			 	}
			 	.column_logo{

			 	}
			 	.column_prix{
					max-width: 60px !important;
			 	}
			 	.column_detail{
		    		max-width: 158px !important;
			 	}
			 	.column_footer{
			 		max-width: 303px !important;
			 	}
			}

		 	@media only screen and (max-width: 592px){
				.news_tab{
					width: 100% !important;
					max-width: 100% !important;
				}
			}   

			table {
				border-collapse: collapse;
	    		border-spacing: 0px;
	    		border-color: #c0c0c0;
			}

		</style>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	</head>

	<body>

		<table border="0" width="100%">

			<tr>
				<td width="5%"></td>
				<td width="95%">
					<p>
						<b>Bonjour {{$user->username}}</b>
					</p>
				</td>
			</tr>

			<tr>
				<td width="5%"></td>
				<td width="95%">
					<p>Vous venez d'ajouter dans la categorie <strong>{{$catalogue->recherche->libelle}}</strong> ce repertoire a votre liste de favoris:
						{{$shortUrl}}</p>
				</td>
			</tr>

		</table>

	</body>
</html>