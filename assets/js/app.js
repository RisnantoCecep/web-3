var basketKey = "budayaliterasi-basket";

function rupiah(nStr) {
	nStr += "";
	x = nStr.split(".");
	x1 = x[0];
	x2 = x.length > 1 ? "." + x[1] : "";
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, "$1" + "," + "$2");
	}
	return "Rp" + x1 + x2;
}

function setCookie(cname, cvalue, exdays) {
	const d = new Date();
	d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
	let expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(";");
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == " ") {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function addToBasket(id, count) {
	var basketOld = getBaskets();
	var success = false;
	for (let i = 0; i < basketOld.length; i++) {
		var keys = basketOld[i].split(":");
		if (keys[0] == id) {
			var number = parseInt(keys[1]) + parseInt(count);
			basketOld[i] = id + ":" + number.toString();
			success = true;
		}
	}
	if (!success) {
		basketOld.push(id + ":" + count);
	}
	setCookie(basketKey, JSON.stringify(basketOld), 1);
	loadBaskets();
}

function getBaskets() {
	var basketOldValue = getCookie(basketKey);
	if (basketOldValue.length > 0) {
		return JSON.parse(basketOldValue);
	}
	return [];
}

function countBaskets() {
	return getBaskets().length;
}

function countBasket(id) {
	var baskets = getBaskets();
	for (let i = 0; i < baskets.length; i++) {
		var keys = baskets[i].split(":");
		if (keys[0] == id) {
			return keys[1];
		}
	}
	return "0";
}

function deleteFromBasket(id, count) {
	var baskets = getBaskets();
	var index = -1;
	for (let i = 0; i < baskets.length; i++) {
		var keys = baskets[i].split(":");
		if (keys[0] == id) {
			var number = parseInt(keys[1]) - parseInt(count);
			if (number > 0) {
				baskets[i] = id + ":" + number.toString();
			} else {
				index = i;
			}
		}
	}
	if (index > -1) {
		baskets.splice(index, 1);
	}
	setCookie(basketKey, JSON.stringify(baskets), 1);

	loadBaskets();
}

function clearBasket() {
	setCookie(basketKey, "", 0);
}

function loadBaskets() {
	var count = countBaskets().toString();
	if ($("#my-basket-count").length > 0) {
		$("#my-basket-count").text(count);
	}
	if ($("#button-basket").length > 0) {
		var id = $("#button-basket").attr("data-id");
		var countThisBasket = countBasket(id);
		var html =
			'<a href="#" class="btn btn-danger btn-md btn-add-basket" data-id="' +
			id +
			'" onClick="addToBasket(\'' +
			id +
			"', '1')\"><i class=\"bi bi-cart-plus-fill\"></i> Keranjang</a>";
		if (countThisBasket > 0) {
			html = '<div class="btn-group">';
			html +=
				'<button type="button" class="btn btn-danger" onClick="deleteFromBasket(\'' +
				id +
				"', '1')\">-</button>";
			html +=
				'<button type="button" class="btn btn-outline-danger">' +
				countThisBasket +
				"</button>";
			html +=
				'<button type="button" class="btn btn-danger" onClick="addToBasket(\'' +
				id +
				"', '1')\">+</button>";
			html += "</div>";
		} else {
		}
		$("#button-basket").html(html);
	}
	if ($(".basket-checkout").length > 0) {
		var baskets = getBaskets();
		var price = 0;
		var total = 0;
		for (let i = 0; i < baskets.length; i++) {
			var keys = baskets[i];
			var spliter = keys.split(":");
			$(".basket-checkout-count-" + spliter[0]).text(spliter[1]);
			$(".basket-checkout-book-" + spliter[0]).attr("data-qty", spliter[1]);
			var priceString = $(".basket-checkout-book-" + spliter[0]).attr(
				"data-price"
			);
			price += parseInt(priceString) * parseInt(spliter[1]);
		}

		var priceKurirString = $(
			"option:selected",
			$("form select[name=kurir_id]")
		).attr("data-price");
		var priceKurir = parseInt(priceKurirString ?? "0");

		total = price + priceKurir;

		$(".basket-checkout-ongkir").text(rupiah(priceKurir));
		$(".basket-checkout-price").text(rupiah(price));
		$(".basket-checkout-price-total").text(rupiah(total));
	}
}

$("form select[name=kurir_id]").on("change", function () {
	loadBaskets();
});

$(".btn-add-basket").on("click", function () {
	var id = $(this).attr("data-id");
	if (id) {
		addToBasket(id, "1");
	}
	return false;
});

$(".basket-checkout-plus").on("click", function () {
	var id = $(this).attr("data-id");
	addToBasket(id, "1");
	return false;
});

$(".basket-checkout-min").on("click", function () {
	var id = $(this).attr("data-id");
	deleteFromBasket(id, "1");
	var countAll = countBasket(id);
	if (!countAll) {
		window.location.reload();
	}
	return false;
});

$(".basket-checkout-del").on("click", function () {
	var id = $(this).attr("data-id");
	var countAll = countBasket(id);
	deleteFromBasket(id, countAll.toString());
	window.location.reload();
});

$(document).ready(function () {
	if ($("#order-view").length > 0) {
		if ($("#order-view").attr("data-clear") == "1") {
			clearBasket();
		}
	}
	loadBaskets();
});

const paymentModal = document.getElementById("paymentModal");
if (paymentModal) {
	paymentModal.addEventListener("show.bs.modal", (event) => {
		const button = event.relatedTarget;
		const recipient = button.getAttribute("data-hash");

		const modalTitle = paymentModal.querySelector(".modal-title");
		const modalBodyId = paymentModal.querySelector(
			".modal-body input[name=id]"
		);
		const modalBodyBank = paymentModal.querySelector(
			".modal-body input[name=bank]"
		);
		const modalBodyAn = paymentModal.querySelector(
			".modal-body input[name=an]"
		);
		const modalBodyRekening = paymentModal.querySelector(
			".modal-body input[name=rekening]"
		);

		if (recipient) {
			modalTitle.textContent = "Ubah Pembayaran";
			var data = atob(recipient);
			data = data ? JSON.parse(data) : null;

			modalBodyId.value = data.payment_id;
			modalBodyBank.value = data.payment_bank;
			modalBodyAn.value = data.payment_an;
			modalBodyRekening.value = data.payment_rekening;
		} else {
			modalTitle.textContent = "Tambah Pembayaran";
			modalBodyId.value = "";
			modalBodyBank.value = "";
			modalBodyAn.value = "";
			modalBodyRekening.value = "";
		}
	});
}

const kurirModal = document.getElementById("kurirModal");
if (kurirModal) {
	kurirModal.addEventListener("show.bs.modal", (event) => {
		const button = event.relatedTarget;
		const recipient = button.getAttribute("data-hash");

		const modalTitle = kurirModal.querySelector(".modal-title");
		const modalBodyId = kurirModal.querySelector(".modal-body input[name=id]");
		const modalBodyName = kurirModal.querySelector(
			".modal-body input[name=name]"
		);
		const modalBodyPrice = kurirModal.querySelector(
			".modal-body input[name=price]"
		);

		if (recipient) {
			modalTitle.textContent = "Ubah Kurir";
			var data = atob(recipient);
			data = data ? JSON.parse(data) : null;

			modalBodyId.value = data.kurir_id;
			modalBodyName.value = data.kurir_name;
			modalBodyPrice.value = data.kurir_price;
		} else {
			modalTitle.textContent = "Tambah Kurir";
			modalBodyId.value = "";
			modalBodyName.value = "";
			modalBodyPrice.value = "";
		}
	});
}
