<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    <style>
        * {
            font-family: DejaVu Sans;
            font-size: 12px;
            /* direction: rtl; */
            /* text-align: right; */
        }
    </style>
</head>

<body>
    <div></div>
    <div>
        <h4>بــنــســلــيــمـــــان فــــــــــــــــي :</h4>
    </div>
    <br><br>
    <div>
        <h1
            style="padding: 20px;
            display: inline-block;
            border: 1px solid black;
            text-align: center;">
            إعلان بالذهاب في عطلة</h1>
    </div>
    <br><br><br><br><br>
    <table>
        <tr>
            <td>الاسم الشخصي و العائلــي</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->personne->nomAr }}&nbsp;{{ $pdf->personne->prenomAr }}</td>
        </tr>
        <tr>
            <td>الــــــــــــــــــــــــدرجة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->personne->grade->gradeAr }}</td>
        </tr>
        <tr>
            <td>مكان الإقــــامـــــــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->lieuResidence }}</td>
        </tr>
        <tr>
            <td>مــــــدة الــعــطــلــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->periode }} أيام</td>
        </tr>
        <tr>
            <td>بــرســــم ســــنــــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->annee }}</td>
        </tr>
        <tr>
            <td>تــــاريــــخ مــغــــادرة الوكــــالــــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->dateDebut }}</td>
        </tr>
        <tr>
            <td>تــــاريــــخ إســتــئــنــــاف الــعــمــــل</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->dateFin }}</td>
        </tr>
        <tr>
            <td>الــــمــكــــان الذي ســتــقــضي فــيــه الــعــطــلــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->lieuConge }}</td>
        </tr>
    </table>
    <br><br><br><br><br><br>
    <div>
        <div id="div1"><strong>الــمــــعــنــــي بالامــــــــــر</strong></div>
        <div id="div2"><strong>الـــرئــــــيـــــــــس</strong></div>
    </div>


</body>

</html>

{{-- //////////////////////////////// --}}
{{-- /////////////////////////////// --}}
