function printDiv() {
			var divContents = document.getElementById("main").innerHTML;
			var printWindow = window.open('', '', 'height=842,width=595');
			printWindow.document.write('<html><head><title>Investment Registration Form</title>');
			printWindow.document.write('<link rel="stylesheet" type="text/css" href="style.css">') 
			printWindow.document.write('</head><body >');  
       		printWindow.document.write(divContents);  
       		printWindow.document.write('</body></html>');  
       		printWindow.document.close(); 
			printWindow.print();
			printWindow.close();
		}