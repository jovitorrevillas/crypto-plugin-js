!function (t){
	ListCurrency = function(elem, obj, prefix){
		var templateControl = {};
		templateControl.nano = function(t, e) {
            return t.replace(/\{([\w\.]*)\}/g,
             function(t, o) {
                for (var i = o.split("."), n = e[i.shift()], M = 0, r = i.length; M < r; M++) n = n[i[M]];
                return void 0 !== n && null !== n ? n : ""
            })
        }

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
			  b.push([val, (1 / a1[val]).toFixed(4)])
			}

			console.log(this.HighestToLowest(b));
		}

		let url = 'https://min-api.cryptocompare.com/data/price';
		let ticker = new XMLHttpRequest();
		apiControl.getPrices(obj);
		ticker.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) {
			    // setInterval(gotValue(this), 5000);
			    apiControl.showPrices(this)
			}
		}
	};

	let e = t.createElement("div"),
		prefix = 'i' + Math.random().toString(36).substring(2, 5) + Math.random().toString(36).substring(2, 5);
	e.id = "ibx-calc-"+prefix, t.write(e.outerHTML);

	let i = document.getElementById("ibx-calc-"+prefix),
	    n = i.previousElementSibling;

	new ListCurrency(
		i, 
		n.getAttribute("currency-selected") ? n.getAttribute("currency-selected") : null,
		prefix
	);

}(document);