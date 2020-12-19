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

<title><xsl:value-of select="/Receiver/Report/@Desc" />: <xsl:value-of select="/Receiver/@Id" /> � <xsl:value-of select="/Receiver/@DateFrom" /> �� <xsl:value-of select="/Receiver/@DateTo" /></title>
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
    <!--xsl:attribute name="id">id<xsl:value-of select="@Id" /></xsl:attribute-->
    <!--xsl:attribute name="border">0</xsl:attribute-->
    <!--xsl:attribute name="width">1000</xsl:attribute-->
    <xsl:attribute name="style">border-collapse:collapse;table-layout:fixed;</xsl:attribute>

    <col width="70" />
    <col width="80" />
    <col width="70" />
    <!--col width="140" /-->
    <!--col width="260" /-->
    <col width="140" />
    <col width="300" />
    <col width="140" />
    <col width="120" />
    <!--col width="100" />
    <col width="100" /-->
    <col width="200" />

      <tr>
        <td class="sign4" rowspan="2"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>
        <td class="sign2" colspan="6">������ �������� ������� � ����������� ���� � �������� ����������� �������� ��������</td>
        <td class="sign5" rowspan="2"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>
      </tr>

      <tr>
         <td class="sign2" colspan="6">������������ �������� "�������� ����� "����������� �������� �������"</td>
      </tr>

      <tr height="4" >
          <td class="np"></td>
      </tr>

      <tr height="20">
       <td class="sign3" colspan="8"></td>
      </tr>

      <tr height="20">
        <td class="tit" colspan="8">����� � ������������ ������� �� ��������</td>
      </tr>

    <xsl:apply-templates select="Report"/>

    <tr>
        <td class="hdr01" rowspan="1" colspan="1">1</td>
        <td class="hdr01" rowspan="1" colspan="1">2</td>
        <td class="hdr01" rowspan="1" colspan="1">3</td>
        <td class="hdr01" rowspan="1" colspan="1">4</td>
        <td class="hdr01" rowspan="1" colspan="1">5</td>
        <td class="hdr01" rowspan="1" colspan="1">6</td>
        <td class="hdr01" rowspan="1" colspan="1">7</td>
        <td class="hdr01" rowspan="1" colspan="1">8</td>
        <!--td class="hdr01" rowspan="1" colspan="1">9</td>
        <td class="hdr01" rowspan="1" colspan="1">10</td>
        <td class="hdr01" rowspan="1" colspan="1">11</td>
        <td class="hdr01" rowspan="1" colspan="1">12</td-->
    </tr>

        <tr>
        <td class="hdr01" rowspan="1" colspan="1">� �.�.</td>
        <td class="hdr01" rowspan="1" colspan="1">����� ����������� ������</td>
        <td class="hdr01" rowspan="1" colspan="1">�������. ����� ������</td>
        <!--td class="hdr01" rowspan="1" colspan="1">��� ���������</td-->
        <!--td class="hdr01" rowspan="1" colspan="1">�������� ���������</td-->
        <!--td class="hdr01" rowspan="1" colspan="1">������������ �������/������</td-->
        <td class="hdr01" rowspan="1" colspan="1">������������ ������� ���������</td>
        <td class="hdr01" rowspan="1" colspan="1">������������ ���������, �� ��������� �������� ��������� ������</td>
        <td class="hdr01" rowspan="1" colspan="1">��� ���������</td>
        <td class="hdr01" rowspan="1" colspan="1">���� �� ��� (<xsl:value-of select="/Receiver/Report/@PriceCurrency"/>) </td>
        <!--class="hdr01" rowspan="1" colspan="1">���-��</td -->
        <!--td class="hdr01" rowspan="1" colspan="1">�����</td-->
        <td class="hdr01" rowspan="1" colspan="1">Memo ��-��</td>
    </tr>

    <xsl:apply-templates select="IpoRpt1"/>

    <tr height="45">
    <td class="tit" colspan="3"><xsl:value-of select="/Receiver/Status/@State" /></td>
    </tr>



<!-- /table -->

</xsl:element>
</xsl:template>

<xsl:template match="Report">
    <tr height="40">
    <td class="tit" colspan="8"><xsl:value-of select="@IssueName" /> (<xsl:value-of select="@IssueCode" />)  </td>
    </tr>

    <tr>
        <td class="hdr01" colspan="2">���� ����������</td>
        <td class="hdr01" colspan="2">��� ������</td>
        <td class="hdr01" colspan="1">��������� ���� (<xsl:value-of select="/Receiver/Report/@PriceCurrency"/>)</td>
        <td class="hdr01" colspan="2">������������ ���������</td>
    </tr>
    <tr height="30">
        <td class="dat02" colspan="2">
            <xsl:value-of select="/Receiver/@DateTo"/>
        </td>
        <td class="dat01" colspan="2">
            <xsl:value-of select="@Addr"/>
        </td>
        <td class="dat01" colspan="1">
            <xsl:value-of select="format-number(@IssueInitialPrice,'###,###.00')"/>
        </td>
        <td class="dat01" colspan="2">
            <xsl:value-of select="@CustomerName"/>
        </td>
        <!--td class="dat02"><xsl:value-of select="IpoRpt1/@CustomerFullName" /></td-->
    </tr>
</xsl:template>


<xsl:template match="IpoRpt1">

    <tr>
        <td class="dat02"><xsl:value-of select="@Num" /></td>
        <td class="dat02"><xsl:value-of select="@RegMoment" /></td>
        <td class="dat01"><xsl:value-of select="@OrderId" /></td>
        <!--td class="dat01"><xsl:value-of select="@CustomerName" /></td>
        <td class="dat02"><xsl:value-of select="@CustomerFullName" /></td-->
        <td class="dat01"><xsl:value-of select="@BrokerFullName" /></td>
        <td class="dat02"><xsl:value-of select="@ParticipantFullName" /></td>
        <td class="dat02" style="mso-number-format:'\@';"><xsl:value-of select="@ParticipantInn" /></td>
        <td class="dat03" style="mso-number-format:0\.00;"><xsl:value-of select="format-number(@Price,'###,###..00')" /></td>
        <!--td class="dat03" style="mso-number-format:0;"><xsl:value-of select="@Qty" /></td-->
        <!--td class="dat03" style="mso-number-format:fixed;"><xsl:value-of select="@Volume" /></td-->
        <td class="dat02"><xsl:value-of select="@BuyerMemo" /></td>
    </tr>

</xsl:template>

</xsl:stylesheet>
