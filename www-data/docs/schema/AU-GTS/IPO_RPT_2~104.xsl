<?xml version="1.0" encoding="Windows-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:decimal-format decimal-separator="." grouping-separator="," />

  <xsl:template match="/">
    <html>

      <head>
        <title>
          <xsl:value-of select="/Receiver/Report/@Desc" />: <xsl:value-of select="/Receiver/@Id" /> за <xsl:value-of select="/Receiver/@DateTo" />
        </title>
                <style>
        a
            {color:#000000;
            text-decoration:none;}
          td
          {
          padding-top:1px;
          padding-right:3px;
          padding-bottom:1px;
          padding-left:3px;
          white-space:nowrap;
          }

          .np
          {
          padding-top:0px;
          padding-right:0px;
          padding-bottom:1px;
          padding-left:0px;
          }

        .titl
            {font-weight:700;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:1.0mm;
            text-align:left;
            vertical-align:top;
            border:none;}
        .foot
            {font-weight:700;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:0.5mm;
            text-align:center;
            vertical-align:top;
            border:none;
            white-space:normal;}
        .tit
            {font-weight:700;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:1.0mm;
            text-align:center;
            vertical-align:top;
            border:none;}
        .title_9
            {font-weight:100;
            font-size:9.0pt;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:0.5mm;
            text-align:left;
            vertical-align:bottom;
            border:none;}
        .titbr
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:0.8mm;
            text-align:center;
            vertical-align:middle;
            border:none;}
        .btn
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            text-align:center;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:nowrap;
            background:silver;}
        .hdr01
               {
               font-size:8.0pt;
               font-weight:100;
               font-family:"Arial CYR", sans-serif;
               color:#315D84;
               text-align:center;
               vertical-align:middle;
               border-top:.5pt solid windowtext;
               border-right:.5pt solid windowtext;
               border-bottom:.5pt solid windowtext;
               border-left:.5pt solid windowtext;
               background:#E7F2F4;
               white-space:normal;
               }
        .hdr02
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            text-align:left;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .hdr03
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            text-align:right;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .hdr04
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            text-align:center;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;
            background:silver;}
        .dat01
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:.1pt;
            text-align:center;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .dat02
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:.1pt;
            text-align:left;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .dat03
            {font-size:8.0pt;
            font-weight:100;
            font-family:"Arial CYR", sans-serif;
            letter-spacing:.1pt;
            text-align:right;
            vertical-align:middle;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
              .sign1
          {
          font-size:7.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:gray;
          text-align:center;
          vertical-align:bottom;
          white-space:normal;
          letter-spacing:2pt;
          }

          .sign2
          {
          font-size:7.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:gray;
          text-align:center;
          vertical-align:top;
          white-space:normal;
          letter-spacing:2pt;
          }

          .sign3
          {
          color:gray;
          text-align:justify;
          vertical-align:top;
          border-top:.5pt solid gray;
          }

          .sign4
          {
          color:gray;
          text-align:left;
          vertical-align:middle;
          white-space:normal;
          }

          .sign5
          {
          color:gray;
          text-align:right;
          vertical-align:middle;
          white-space:normal;
          }



</style>
      </head>
      <body>
        <xsl:apply-templates />
      </body>
    </html>
  </xsl:template>

  <xsl:template match="Receiver">

    <xsl:element name="table">
    <xsl:attribute name="style">border-collapse:collapse;table-layout:fixed;</xsl:attribute>

           <tr>
              <td class="sign4" rowspan="2" colspan="1"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>
              <td class="sign1" colspan="8">Данный документ передан в электронном виде и подписан электронной цифровой подписью</td>
              <td class="sign5" rowspan="2"  colspan="1"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>
           </tr>

           <tr>
            <td class="sign2" colspan="9">Акционерного общества "Товарная биржа "Евразийская Торговая Система"</td>
           </tr>

           <tr height="20">
            <td class="sign3" colspan="11"></td>
           </tr>

          <tr>
             <td colSpan="11" class="np" />
             </tr>

          <tr>
            <td colSpan="5" class="np">

              <xsl:element name="table">
                <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

                <col width="20%" />
                <col />
                <col width="100%"/>
                <col />
                <col />

                <tr>
                  <td class="hdr01" colspan="5">Акционерное общество "Товарная биржа "Евразийская Торговая Система"</td>
                </tr>
                <tr>
                  <td class="dat02" colspan="5">
                    <xsl:value-of select="Report/@Desc" />
                  </td>
                </tr>
                <tr>
                  <td class="hdr01">Участник</td>
                  <td class="dat02">
                    <xsl:value-of select="@Id" />
                  </td>
                  <td class="dat02" colspan="3">
                    <xsl:value-of select="@Name" />
                  </td>
                </tr>
                <tr>
                  <td class="hdr01">Дата отчета</td>
                  <td class="dat02">
                    <xsl:value-of select="@DateTo" />
                  </td>
                  <td class="dat02"></td>
                  <td class="hdr01">Сформирован</td>
                  <td class="dat02">
                    <xsl:value-of select="@DateRpt" />
                  </td>
                </tr>
                </xsl:element>
         </td>
          </tr>

      <tr height="4" >
        <td class="np"></td>
      </tr>

      <tr>
        <td class="hdr01" >Номер сделки</td>
        <td class="hdr01" >Наименование клиента</td>
        <td class="hdr01" >РНН Клиента</td>
        <td class="hdr01" >Дата и время регистрации сделки</td>
        <!--td class="hdr01" >Дата исполнения сделки</td-->
        <td class="hdr01" >Покупка / продажа</td>
        <td class="hdr01" >Код Товара</td>
        <td class="hdr01" >Кол-во</td>
        <td class="hdr01" >Валюта сделки</td>
        <!--td class="hdr01" >Цена одной единицы Товара</td-->
        <td class="hdr01" >Сумма сделки</td>
        <td class="hdr01" >Код контр- агента</td>
        <td class="hdr01" >Комментарий из ТС</td>
      </tr>

      <xsl:apply-templates select="Issue/Contract"/>

      <tr height="10" >
        <td class="np"></td>
      </tr>

      <tr height="70" >
        <td class="sign4" colspan="8">Председатель Правления  АО «Товарная биржа «ЕТС»</td>
        <td class="sign4" colspan="3">Оразаев К.Ч.</td>
      </tr>
      <tr height="40" >
        <td class="sign1" colspan="3">Выписка из торговой системы верна</td>
      </tr>
      <tr>
        <td class="sign3" colspan="3">Директор ДИТП  </td>
        <td class="sign4" colspan="5"></td>
        <td class="sign4" colspan="3">Кубеев Т.К.</td>
      </tr>

    </xsl:element>

  </xsl:template>

  <xsl:template match="Contract">
    <tr>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Number" />
      </td>

      <td class="dat01" style="mso-number-format:'\@'">
            <xsl:value-of select="Client/@ClientName" />
      </td>

      <td colSpan="1" class="dat01" style="mso-number-format:'\@'">
        <xsl:value-of select="Client/@Inn" />
      </td>


      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Moment" />
      </td>

      <td colSpan="1" class="dat01">

        <xsl:choose>

          <xsl:when test="@Action[.='B']">
            <xsl:text>покупка</xsl:text>
          </xsl:when>
          <xsl:when test="@Action[.='S']">
            <xsl:text>продажа</xsl:text>
          </xsl:when>

        </xsl:choose>

      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="../@Code" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Qty" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Currency" />
      </td>

      <td colSpan="1" class="dat01" style="mso-number-format:'\#\,\#\#0\.00'">
        <xsl:value-of select="format-number(@Amt,'0.00')" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="CounterParty/@ContrCode" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Memo" />
      </td>

    </tr>

  </xsl:template>

</xsl:stylesheet>
