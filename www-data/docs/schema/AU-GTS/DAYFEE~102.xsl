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

          .dat01
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:center;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat01_l
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat01L
          {
          font-size:8.0pt;
          font-weight:100;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          white-space:normal;
          }

          .dat01_r
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:right;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat02
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat02L
          {
          font-size:8.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
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
      <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

      <tr>
        <td colSpan="5" class="np">

          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

            <col />
            <col width="100%" />
            <col />

            <tr>

              <td class="sign4" rowspan="2"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>

              <td class="sign1">Данный документ передан в электронном виде и подписан электронной цифровой подписью</td>

              <td class="sign5" rowspan="2"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>

            </tr>

            <tr>
          <td class="sign2">Акционерного общества "Товарная биржа "Евразийская Торговая Система"</td>
            </tr>

           <tr height="4" >
             <td class="np"></td>
           </tr>

            <tr height="20">
          <td class="sign3" colspan="3"></td>
            </tr>

          </xsl:element>

    </td>
      </tr>

      <tr>
        <td colSpan="5" class="np">

          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

            <col width="20%" />
            <col width="20%" />
            <col width="80%" />
            <col width="20%" />
            <col width="20%" />

            <tr>
              <td class="hdr01" colspan="5">Акционерное общество "Товарная биржа "Евразийская Торговая Система"</td>
            </tr>
            <tr>
              <td class="dat02L" colspan="5">
                <xsl:value-of select="Report/@Desc" />
              </td>
            </tr>
            <tr>
              <td class="hdr01">Участник</td>
              <td class="dat02">
                <xsl:value-of select="@Id" />
              </td>
              <td class="dat01_l" colspan="3">
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

<!--      <col width="70" />
      <col width="130"/>
      <col width="80" />
      <col width="80" />
      <col width="60" />
      <col width="120"/>
      <col width="65" />
      <col width="65" /> -->

      <xsl:apply-templates select="FeeScheme"/>

    </xsl:element>

  </xsl:template>

  <xsl:template match="FeeScheme">

    <tr height="8" >
      <td colSpan="1" class="np"></td>
    </tr>

    <tr>
      <td colSpan="1" class="hdr01">Классификатор комиссионной схемы</td>
      <td colSpan="1" class="hdr01">Категория комиссии</td>
      <td colSpan="1" class="hdr01">Тип комиссии</td>
      <td colSpan="2" class="hdr01">Описание комиссии</td>
    </tr>
    <tr>
      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Name" />
      </td>
      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Ctg" />
      </td>
      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Type" />
      </td>
      <td colSpan="2" class="dat01L">
        <xsl:value-of select="@Descr" />
      </td>
    </tr>

    <tr>
      <td colSpan="2" class="hdr01">Номер сделки</td>
      <td colSpan="1" class="hdr01">Код Клиента</td>
      <td class="hdr01">Сумма комиссии, каз. тенге</td>
      <td class="hdr01">в т.ч. НДС</td>
    </tr>

    <xsl:apply-templates select="Fee"/>
    <xsl:apply-templates select="Total"/>

  </xsl:template>

  <xsl:template match="Total">

      <tr>
        <td class="np" colspan="2"></td>
        <td class="dat01_r" colspan="1">ИТОГО</td>
        <xsl:apply-templates select="FeeSum[@Currency='KZT']" />
      </tr>
      <tr>
         <td class="np" colspan="5"></td>
      </tr>

  </xsl:template>

  <xsl:template match="Fee">

    <tr>

      <td colSpan="2" class="dat01_l">
        <xsl:value-of select="@Number" />
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="Client/@ClientCode" />
      </td>

      <xsl:apply-templates select="FeeSum[@Currency='KZT']" />

    </tr>

  </xsl:template>

  <xsl:template match="FeeSum[@Currency='KZT']">

    <td class="dat01_r">
      <xsl:value-of select="format-number(@Sum,'0.00')" />
    </td>
    <td class="dat01_r">
      <xsl:value-of select="format-number(@Vat,'0.00')" />
    </td>

  </xsl:template>

</xsl:stylesheet>