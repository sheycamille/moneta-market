paypalFunc = function (amount, route) {
    paypal
        .Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [
                        {
                            amount: {
                                value: amount,
                            },
                        },
                    ],
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    alert(
                        "We have successfully received your funds and are crediting your trading account. You are being redirected in the next 10seconds, if not, visit your live accounts and check the balance, if the account is not yet credited. Contact our live chat support. Thanks for your patience."
                    );
                    console.log(details.purchase_units[0].amount.value);
                    // Call your server to save the transaction
                    return fetch(
                        "/dashboard/paypalverify/" +
                            Math.round(details.purchase_units[0].amount.value),
                        {
                            method: "post",
                            headers: {
                                "content-type": "application/json",
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            body: JSON.stringify({
                                orderid: data.orderID,
                            }),
                        }
                    ).then((resp) => {
                        window.location.replace(route);
                    });
                });
            },
        })
        .render("#paypal-button-container");
};
