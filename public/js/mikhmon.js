function sortTable(e, t, n) {
	var l, o = e.tBodies[0],
		i = Array.prototype.slice.call(o.rows, 0);
	for (n = -(+n || -1), i = i.sort(function(e, l) {
			return n * e.cells[t].textContent.trim().localeCompare(l.cells[t].textContent.trim())
		}), l = 0; l < i.length; ++l) o.appendChild(i[l])
}

function makeSortable(e) {
	var t, n = e.tHead;
	if (n && (n = n.rows[0]) && (n = n.cells), n)
		for (t = n.length; --t >= 0;) ! function(t) {
			var l = 1;
			n[t].addEventListener("click", function() {
				sortTable(e, t, l = 1 - l)
			})
		}(t)
}

function makeAllSortable(e) {
	for (var t = (e = e || document.body).getElementsByTagName("table"), n = t.length; --n >= 0;) makeSortable(t[n])
}
$(document).ready(function(){
    makeAllSortable();
});

