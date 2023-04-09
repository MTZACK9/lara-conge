<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
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
            طلب رخصة إدارية برسم سنة 2021</h1>
    </div>
    <br><br><br>
    <div>
        <strong>الــــــرقـــم :</strong>
        <strong><span>2022/</span><span>{{ $pdf->valeur }}/</span><span>ش.م</span></strong>
    </div>
    <br>
    <table>
        <tr>
            <td>الاسم الشخصي و العائلــي</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->personne->nomAr }}&nbsp;{{ $pdf->personne->prenomAr }}</td>
        </tr>
        <tr>
            <td>الإطـــــــار والــــوظــبـــــــفـــــــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->personne->grade->gradeAr }}</td>
        </tr>
        <tr>
            <td>مكان الإقــــامـــــــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->lieuResidence }}</td>
        </tr>
        <tr>
            <td>الــمــــــدة الــعــطــلــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->periode }} أيام</td>
        </tr>
        <tr>
            <td>بــرســــم ســــنــــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->annee }}</td>
        </tr>
        <tr>
            <td>الـــمـــــــدة الـــمـــتـــبـــقـــبـــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->duree }} من سنة {{ $pdf->annee }}</td>
        </tr>
        <tr>
            <td>الـــعـــنـــوان خـــلال مـــدة الـــرخـــصـــة</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->lieuConge }}</td>
        </tr>
        <tr>
            <td>الــــــهــــــاتـــــــــــــــف</td>
            <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{ $pdf->tele }}</td>
        </tr>
    </table>
    <br><br><br><br><br><br>
    <div>

        <div class="div2"><strong>تـــــــــاريـــــــــــــــخ الإمــــــضــــــاء</strong></div>


    </div>
    <br><br>
    <hr>
    <br>
    <div>
        <table>
            <tr>
                <td>رأي الــــرئــــيــــس الــمــــبــــاشــــــر</td>
                <td><strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
                <td>بالموافقة</td>
                <td>بعدم الموافقة</td>


            </tr>
            <tr>
                <td>يمكن أن تمنح الرخصة من </td>
                <td><strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
                <td>{{ $pdf->dateDebut }}</td>

            </tr>

        </table>
    </div>
    <br><br>
    <table id="tablef" style="border-collapse: collapse;border: 1px solid black;width: 80%;">
        <tr>
            <th style="border-collapse: collapse;border: 1px solid black;">
                <center>رأي رئــــيــــس الــمــــصــلــحــــة</center>
            </th style="border-collapse: collapse;border: 1px solid black;">
            <th style="border-collapse: collapse;border: 1px solid black;">
                <center>رأي رئــــيــــس الــقــســم</center>
            </th style="border-collapse: collapse;border: 1px solid black;">
            <th style="border-collapse: collapse;border: 1px solid black;">
                <center>رأي الــمــديــــر</center>
            </th>

        </tr>

        <tr>
            <td style="border-collapse: collapse; border-right: 1px solid black;">
                <center>بــالــمــوافــقــة</center>
            </td>
            <td style="border-collapse: collapse; border-right: 1px solid black;">
                <center>بــالــمــوافــقــة</center>
            </td>
            <td style="border-collapse: collapse; border-right: 1px solid black;">
                <center>بــالــمــوافــقــة</center>
            </td>

        </tr>
        <tr>
            <td class="trb"
                style="border-collapse: collapse;
                 border-right: 1px solid black;
                 border-bottom: 1px solid black;">
                <center>بــعــدم الــمــوافــقــة</center>
            </td>
            <td class="trb"
                style="border-collapse: collapse;
                 border-right: 1px solid black;
                 border-bottom: 1px solid black;">
                <center>بــعــدم الــمــوافــقــة</center>
            </td>
            <td class="trb"
                style="border-collapse: collapse;
                 border-right: 1px solid black;
                 border-bottom: 1px solid black;">
                <center>بــعــدم الــمــوافــقــة</center>
            </td>

        </tr>
        <tr>
            <td style="border-collapse: collapse; border-right: 1px solid black;">الــتــاريــخ:</td>
            <td style="border-collapse: collapse; border-right: 1px solid black;">الــتــاريــخ:</td>
            <td style="border-collapse: collapse; border-right: 1px solid black;">الــتــاريــخ:</td>

        </tr>
        <tr>
            <td style="border-collapse: collapse; border-right: 1px solid black;">الإمــضــاء</td>
            <td style="border-collapse: collapse; border-right: 1px solid black;">الإمــضــاء</td>
            <td style="border-collapse: collapse; border-right: 1px solid black;">الإمــضــاء</td>

        </tr>
    </table>


</body>

</html>
