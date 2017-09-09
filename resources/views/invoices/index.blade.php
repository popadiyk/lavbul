<!DOCTYPE>
<HTML>
<HEAD>
    <TITLE>Накладна № {{$invoice->id}} від {{$invoice->created_at->format('Y-m-d')}}</TITLE>
    <meta  http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="noindex, nofollow">
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
        <span>Попадюк Андрій Валентинович</span>
        <br>
        <span class="bold">Банк отримувача:</span>
        <span>ПриватБанк</span>

        <span class="bold">Картка:</span>
        <span>4149 4393 0032 6356</span>
    </p>
    <p>
        <span class="bold">Адреса:</span>
        <span> м. Вінниця, проспект Коцюбинського, 70, ТЦ "ПетроЦентр", 2-ий поверх, бутік 7</span>
        <span class="bold">телефон:</span>
        <span>(063) 153 80 28</span>
    </p>
    <table style="border: black solid 1px;">
        <caption>
            Накладна № {{$invoice->id}} від {{$invoice->created_at->format('Y-m-d')}}
        </caption>
        <thead>
            <tr>
                <th style="width: 30px; text-align: center;">#</th>
                <th style="width: 60px; text-align: center;">Артикул</th>
                <th style="width: 330px; text-align: center;">Назва</th>
                <th style="width: 100px; text-align: center;">Кількість</th>
                <th style="width: 80px; text-align: center;">Ціна</th>
                <th style="width: 80px; text-align: center;">Сумма</th>
            </tr>
        </thead>
        <tbody>
                @foreach($products as $product)
                    <tr style="background-color: lightgray;">
                        <td style="text-align: center;">{{$loop->iteration}}</td>
                        <td style="text-align: center;">{{ $product->product->marking }}</td>
                        <td>{{ $product->product->title }}</td>
                        <td style="text-align: center;">{{ $product->quantity }}</td>
                        <td style="text-align: center;">{{ number_format($product->sum/$product->quantity, 2) }}</td>
                        <td style="text-align: center;">{{ number_format($product->sum, 2)}}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
    <p style="text-align: right;">
        <span class="bold">Сума:</span>
        <span>{{number_format($invoice->total_account, 2)}} грн.</span>
    </p>
    <p>
        <span class="bold">Важливо:</span>
        <span>Рахунок на оплату дійсний 24 години від моменту створення! Якщо рахунок прострочений, магазин не несе відповідальності за наявність товару!</span>
    </p>

</div>
</body>
</HTML>