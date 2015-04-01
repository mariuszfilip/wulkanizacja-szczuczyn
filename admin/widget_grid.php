<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
     
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<style type="text/css">
		
			#grid {
				width: 400px;
			}
			
			#grid thead td {
				cursor: pointer;
				color: White;
				font-weight: bold;
				padding: 2px;
				border: 1px solid #8F9D11;
				background-color: #B7C059;
			}
			
			#grid tbody td {
				cursor: pointer;
				padding: 2px;
				border: 1px solid #D9D6D6;
			}
			
			#grid tbody .select {
				background-color: #D9D6D6;
			}
		
		</style>
		<script type="text/javascript" src="js/mintAjax.js"></script>

		<script type="text/javascript">
		
			function OnLoad() {
				var grid = mint.gui.CreateGridWidget("grid");
				
				grid.selectClass = "select";
				grid.remoteRowSeparator = ";";
				
				grid.AddSortCells();
				grid.SetSelective();
				
				grid.InsertRow("40", "Consectetuer", "18-05-2008");
				grid.InsertRow("18", "Adipiscing", "24-06-2007");
				
				grid.LoadTextData("remote.txt");
			}
		
		</script>
	</head>
	<body onload="OnLoad()">
	
		<table id="grid">
			<thead>
				<tr>
					<td>Liczba</td>
					<td>Tekst</td>

					<td>Data</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>15</td>
					<td>Lorem</td>

					<td>05-02-2006</td>
				</tr>
				<tr>
					<td>5.8</td>
					<td>Ipsum</td>
					<td>02-05-2007</td>
				</tr>

				<tr>
					<td>26</td>
					<td>Dolor</td>
					<td>12-06-2008</td>
				</tr>
				<tr>
					<td>5.2</td>

					<td>Sit Amet</td>
					<td>25-10-2007</td>
				</tr>
			</tbody>
		</table>
		
	</body>
</html>
</html>