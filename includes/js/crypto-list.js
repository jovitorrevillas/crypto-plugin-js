!function (t){
	ListCurrency = function(elem, obj, prefix){
	    var apiControl = {};
		apiControl.HighestToLowest = function(x){
			return x.sort(function(a,b){return b[1] - a[1]});
		}

		apiControl.getPrices = function(obj){
			let fsyms = 'fsym=USD',
			    tsyms = 'tsyms='+obj;
			  ticker.open( 'get', url + '?' + fsyms + '&' + tsyms, true );
			  ticker.send();
		}

		apiControl.showPrices = function(a){
			let a1 = JSON.parse(a.responseText);
			let b = [];

			for(let val in a1){
			  b.push([val, (1 / a1[val])])
			}

			return this.HighestToLowest(b);
		}

		let url = 'https://min-api.cryptocompare.com/data/price';
		let i = document.getElementById("ibx-calc-"+prefix).getElementsByClassName("crypto-display-container")[0];
		let ticker = new XMLHttpRequest();
		apiControl.getPrices(obj);
		setInterval(apiControl.getPrices(obj), 1000)
		ticker.onreadystatechange = function(){

			if (this.readyState == 4 && this.status == 200) {
			    let prices = apiControl.showPrices(this);

			    for(let a in prices){
			    	let divRow = t.createElement('div');
			    	divRow.className = 'crypto-row';

			    	for( let i = 0 ; i < prices[a].length ; i++ ){
			    		let column = t.createElement('div');
				    	column.className = 'crypto-column';
				    	let span = t.createElement('span');
				    	span.innerText = '$';
			    		let a1 = t.createElement('div');
			    		(i!=0) ? column.appendChild(span) : '';
				    	a1.className = (i==0) ? ('crypto-symbol-' + prices[a][i]) : ('crypto-price-' + prices[a][i-1]);
				    	(i!=0) ? a1.style.color = span.style.color  = "green" : '';
				    	a1.innerText = (i==0) ? prices[a][i] : parseFloat(prices[a][i]).toFixed(4);
				    	column.appendChild(a1);
				    	divRow.appendChild(column);
			    	}

			    	i.appendChild(divRow)
			    }

			}
		}

		// Create a ticker that updates the values
		t.addEventListener("DOMContentLoaded", function(event){
			setInterval(function(){
				console.log('new');
				apiControl.getPrices(obj);
				ticker.onreadystatechange = function(){

					if (this.readyState == 4 && this.status == 200) {
						let prices = apiControl.showPrices(ticker);

						for(let a in prices){
							let i = document.getElementById("ibx-calc-"+prefix).getElementsByClassName("crypto-price-"+prices[a][0])[0];
							if( i.innerText != parseFloat(prices[a][1]).toFixed(4) )
								i.style.color = span.style.color = ( i.innerText > parseFloat(prices[a][1]).toFixed(4) ) ? "red" : "green" ;
							i.innerText = parseFloat(prices[a][1]).toFixed(4);
							console.log(i);
						}
					}
				}
			}, 5000)
		});
	};

	// Create template
	let prefix = 'i' + Math.random().toString(36).substring(2, 5) + Math.random().toString(36).substring(2, 5);

	// parent
	let e = t.createElement("div");
	e.id = "ibx-calc-"+prefix;

	// container
	let eRow = t.createElement("div");
	eRow.className = "crypto-display-container";

	// title
	let eRowTitle = t.createElement("div");
	eRowTitle.className = 'crypto-title';

	// appendChilds
	eRow.appendChild(eRowTitle)
	e.appendChild(eRow)

	t.write(e.outerHTML);

	let i = document.getElementById("ibx-calc-"+prefix),
	    n = i.previousElementSibling;
	    eRowTitle.innerText = n.getAttribute("shortcode-title") ? n.getAttribute("shortcode-title") : null;
	new ListCurrency(
		i, 
		n.getAttribute("currency-selected") ? n.getAttribute("currency-selected") : null,
		prefix
	);

}(document);
