<?xml version="1.0" encoding="Windows-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:decimal-format decimal-separator="." grouping-separator="," />

 <xsl:variable name="CR" select="'&#013;'"/>
    <xsl:variable name="LF" select="'&#010;'"/>
    <xsl:variable name="CRLF" select="'&#013;&#010;'"/>
    <xsl:variable name="QUOT" select="'&quot;'"/>

<xsl:template match="/">

<html>

<head>

<title><xsl:value-of select="/Receiver/Report/@Desc" />: <xsl:value-of select="/Receiver/@Id" /> с <xsl:value-of select="/Receiver/@DateFrom" /> по <xsl:value-of select="/Receiver/@DateTo" /></title>
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

.tit_2
    {font-size:9.0pt;
    font-weight:700;
    font-family:"Arial CYR", sans-serif;
    letter-spacing:1.0mm;
    text-align:center;
    vertical-align:top;
    border:none;}

.title_9
    {font-weight:900;
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
       font-size:9.0pt;
       font-weight:600;
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

    <col width="100" />
    <col width="700" />
    <col width="150" />
    <col width="100" />
    <col width="100" />

      <tr height="40">
        <td class="tit" colspan="4">Еженедельный ценовой обзор для АО Продкорпорация</td>
      </tr>
      <tr height="40">
        <td class="tit_2" colspan="4"> с <xsl:value-of select="@DateFrom" /> по <xsl:value-of select="@DateTo"/> </td>
      </tr>

    <!--tr>
        <td class="hdr01" rowspan="1" colspan="1">1</td>
        <td class="hdr01" rowspan="1" colspan="1">2</td>
        <td class="hdr01" rowspan="1" colspan="1">3</td>
    </tr-->

    <tr>
        <td class="hdr01" rowspan="1" colspan="1">Инструмент</td>
        <td class="hdr01" rowspan="1" colspan="1">Название</td>
        <td class="hdr01" rowspan="1" colspan="1">Средневзвешенная цена за одну тонну</td>
        <td class="hdr01" rowspan="1" colspan="1">Объем в тенге</td>
        <td class="hdr01" rowspan="1" colspan="1">Объем в тоннах</td>
    </tr>
    <xsl:apply-templates select="List"/>

</xsl:element>
</xsl:template>

<xsl:template match="List">

      <tr height="20">
        <!--td class="title_9" colspan="3"><xsl:value-of select="@Name" /></td-->
        <td class="hdr04" colspan="5"><xsl:value-of select="@Name" /></td>
      </tr>

    <xsl:apply-templates select="Idx"/>

</xsl:template>


 <xsl:template match="Idx">

    <tr>
        <td class="dat02"><xsl:value-of select="@Issue" /></td>
        <td class="dat02"><xsl:value-of select="@Source" /></td>
        <td class="dat01"><xsl:value-of select="@AvrPrice" /></td>
        <td class="dat01"><xsl:value-of select="@Volume" /></td>
        <td class="dat01"><xsl:value-of select="@Qty" /></td>
     </tr>

</xsl:template>

</xsl:stylesheet>
