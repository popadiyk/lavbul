<!DOCTYPE>
<HTML>
<HEAD>
    <TITLE>The document title</TITLE>
    <meta  http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>
        body {
            font-family: DejaVu Sans;
        }
        .bold{
            font-weight: bold;
        }
    </style>
</HEAD>
<body>
<div style="text-align: center;">
    <h2>Рахунок на оплату №{{$invoice->id}}</h2>
</div>
<div>
    <h3>
        Реквізити отримувача:
    </h3>
    <p>
        <span class="bold">Отримувач:</span>
        <span>Андрюха</span>
    </p>
    <p>
        <span class="bold">Банк отримувача:</span>
        <span>Банк Андрюхи</span>

        <span class="bold">МФО:</span>
        <span>Код Андрюхиного банку</span>

        <span class="bold">ЄДРПОУ:</span>
        <span>Код Андрюхиного банку</span>

        <span class="bold">Р/р:</span>
        <span>Код Андрюхиного банку,</span>
    </p>
    <p>
        <span class="bold">Юридична адреса:</span>
        <span>Адресса  Андрюхи.</span>
        <span class="bold">телефон:</span>
        <span>0977503427</span>
    </p>
    <table>

    </table>
    <p>
        <span class="bold">Сума:</span>
        <span>{{$invoice->total_account}}грн.</span>
    </p>
    <p>
        <span class="bold">Призначення платежу:</span>
        <span>Оплата рахунку</span>
    </p>

    @foreach($products as $product)
        <p>{{ $product->product->title }}</p>
    @endforeach
</div>
</body>
</HTML>