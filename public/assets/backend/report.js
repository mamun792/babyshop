

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.submits').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const { jsPDF } = window.jspdf;
            const tableId = this.getAttribute('data-table-id');
            const filename = this.getAttribute('data-filename');

           
            const dateFilter = document.querySelector('#date_filter').value;
            const startDate = document.querySelector('#start_date').value;
            const endDate = document.querySelector('#end_date').value;

            
            const spinner = document.createElement('div');
            spinner.classList.add('spinner');
            spinner.innerText = 'Generating PDF...';
            document.body.appendChild(spinner);
   
            const doc = new jsPDF();

            // URL of the logo image
            const logoUrl = '/assets/logo.png';

          
            fetch(logoUrl)
                .then(response => response.blob())
                .then(blob => {
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        const logoBase64 = reader.result;

                      
                        const logoX = 10; 
                        const logoY = 10;
                        const logoWidth = 30; 
                        const logoHeight = 15; 
                        doc.addImage(logoBase64, 'PNG', logoX, logoY, logoWidth, logoHeight);

                   

                        // Add filter information
                        doc.setFontSize(10);
                        let filterText = '';
                        switch(dateFilter) {
                            case 'today':
                                filterText = 'Filter: Today';
                                break;
                            case 'yesterday':
                                filterText = 'Filter: Yesterday';
                                break;
                            case 'last_7_days':
                                filterText = 'Filter: Last 7 Days';
                                break;
                            case 'this_month':
                                filterText = 'Filter: This Month';
                                break;
                            case 'last_month':
                                filterText = 'Filter: Last Month';
                                break;
                            default:
                                filterText = 'Filter: None';
                        }
                        if (filterText !== 'Filter: None') {
                            doc.text(filterText, 10, 40);
                        }

                       
                        let dateRangeText = '';
                        if (startDate && endDate) {
                            dateRangeText = `Date Range: ${startDate} to ${endDate}`;
                        } else if (startDate) {
                            dateRangeText = `Start Date: ${startDate}`;
                        } else if (endDate) {
                            dateRangeText = `End Date: ${endDate}`;
                        }
                        if (dateRangeText) {
                            doc.text(dateRangeText, 10, 50);
                        }

                        // Get table data
                        const table = document.querySelector(`#${tableId}`);
                        const rows = Array.from(table.querySelectorAll('tbody tr'));

                        // Calculate totals
                        let totalQuantity = 0;
                        let totalAmount = 0;
                        const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText.trim());
                        // const quantityIndex = headers.indexOf('Quantity');
                        // const amountIndex = headers.indexOf('Amount');

                     

                        const data = rows.map(row => {
                            const cells = Array.from(row.querySelectorAll('td')).map(td => td.innerText.trim());
                            console.log('Row Cells:', cells); // Debugging line

                            // Ensure that the values are correctly parsed
                            // const quantity = parseFloat(cells[quantityIndex].replace(/[^0-9.-]/g, '')) || 0;
                            // const amount = parseFloat(cells[amountIndex].replace(/[^0-9.-]/g, '')) || 0;

                            // console.log('Quantity:', quantity); // Debugging line
                            // console.log('Amount:', amount); // Debugging line

                            // totalQuantity += quantity;
                            // totalAmount += amount;

                            return cells;
                        });

                        // Add headers and data to PDF
                        doc.autoTable({
                            startY: (dateRangeText ? 60 : 50), 
                            head: [headers],
                            body: data,
                            theme: 'striped', 
                            headStyles: { fillColor: [41, 128, 185] }, 
                            alternateRowStyles: { fillColor: [242, 242, 242] }
                        });

                        // Add total summary
                        // const summaryY = doc.autoTable.previous.finalY + 10; // Y position after the table
                        // doc.setFontSize(12);
                        // doc.setFont('helvetica', 'bold');
                        // doc.text(`Total Quantity: ${totalQuantity}`, 10, summaryY);
                        // doc.text(`Total Amount: ${totalAmount.toFixed(2)}`, 10, summaryY + 10);

                        // Save the PDF
                        doc.save(filename);

                        // Remove loading spinner
                        document.body.removeChild(spinner);
                    };
                    reader.readAsDataURL(blob);
                });
        });
    });
});




