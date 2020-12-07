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

    <xsl:element name="table">
      <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

      <col width="10%" />
      <col />
      <col width="100%"/>
      <col />
      <col />

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

    <xsl:element name="table">
      <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

      <xsl:apply-templates select="SettlPairGroup"/>

    </xsl:element>

  </xsl:template>

  <xsl:template match="SettlPairGroup">

      <xsl:apply-templates select="Client"/>

  </xsl:template>

  <xsl:template match="Client">

    <tr height="8" >
      <td colSpan="1" class="np"></td>
    </tr>

    <tr>
      <td colSpan="15" class="np">

        <xsl:element name="table">
          <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

          <tr>
            <td colSpan="1" class="hdr01">Код Клиента</td>
            <td colSpan="1" class="hdr01">РНН Клиента</td>
            <td colSpan="1" class="hdr01">Код РО по денежным средствам</td>
            <td colSpan="1" class="hdr01">Номер Торгового счета для учета суммы денежных средств</td>
            <td colSpan="1" class="hdr01">Код РО по складским свидетельствам</td>
            <td colSpan="1" class="hdr01">Номер Торгового счета для учета складских свидетельств</td>
          </tr>

          <tr>
            <td colSpan="1" class="dat01">
              <xsl:value-of select="@ClientCode" />
            </td>
            <td colSpan="1" class="dat01">
              <xsl:value-of select="@Inn" />
            </td>
            <xsl:apply-templates select="../SettlPair/Account"/>
          </tr>

        </xsl:element>
      </td>
    </tr>
    <tr>
      <td class="hdr01">Номер 1й части сделки</td>
      <td class="hdr01">Дата рег-ции Сделки</td>
      <td class="hdr01">1я часть сделки</td>
      <td class="hdr01">Код Товара</td>
      <td class="hdr01">Кол-во Т., в ед. изм. Т.</td>
      <td class="hdr01">Валюта Сделки</td>
      <td class="hdr01">Цена одной ед. Т. в 1й части сделки</td>
      <td class="hdr01">Сумма 1й части сделки</td>
      <td class="hdr01">Сумма 2й части сделки</td>
      <td class="hdr01">Цена одной ед. Т. во 2й части сделки</td>
      <td class="hdr01">Номер 2й части сделки</td>
      <td class="hdr01">2я часть сделки</td>
      <td class="hdr01">Состояние 2й части сделки</td>
      <td class="hdr01">Дата исп-ния 2й части сделки</td>
      <td class="hdr01">Дата факт. исп-ния 2й части сделки</td>
      <td class="hdr01">Код контр- агента</td>
      <td class="hdr01">Код Клиента контрагента</td>
    </tr>

    <xsl:apply-templates select="Issue"/>

  </xsl:template>

  <xsl:template match="Issue">
    <xsl:apply-templates select="Contract"/>
  </xsl:template>

  <xsl:template match="Account[@OrgType='B']">

    <td colSpan="1" class="dat01">
      <xsl:choose>
        <xsl:when test="@OrgType[.='B']">
          <xsl:value-of select="@OrgCode"/>
        </xsl:when>
      </xsl:choose>
    </td>
    <td colSpan="1" class="dat01" style="mso-number-format:'\@';">
      <xsl:choose>
        <xsl:when test="@OrgType[.='B']">
          <xsl:value-of select="@AccCode"/>
        </xsl:when>
      </xsl:choose>
    </td>
  </xsl:template>

  <xsl:template match="Account[@OrgType='D']">
    <td colSpan="1" class="dat01">
      <xsl:choose>
        <xsl:when test="@OrgType[.='D']">
          <xsl:value-of select="@OrgCode"/>
        </xsl:when>
      </xsl:choose>
    </td>
    <td colSpan="1" class="dat01" style="mso-number-format:'\@';">
      <xsl:choose>
        <xsl:when test="@OrgType[.='D']">
          <xsl:value-of select="@AccCode"/>
        </xsl:when>
      </xsl:choose>
    </td>
  </xsl:template>

  <xsl:template match="Contract">
    <tr>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Number" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="substring(@Moment, 1, 10)" />
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

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="../@Code" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="@Qty" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Currency" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Price,'0.00000')" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Amt,'0.00')" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(Contract/@Amt,'0.00')" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(Contract/@Price,'0.00000')" />
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="Contract/@Number" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:choose>
          <xsl:when test="Contract/@Action[.='B']">
            <xsl:text>покупка</xsl:text>
          </xsl:when>
          <xsl:when test="Contract/@Action[.='S']">
            <xsl:text>продажа</xsl:text>
          </xsl:when>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:choose>
          <xsl:when test="Contract/@State[.='WAITING']">
            <xsl:text>не исп-на</xsl:text>
          </xsl:when>
          <xsl:when test="Contract/@State[.='EXECUTED']">
            <xsl:text>исполнена</xsl:text>
          </xsl:when>
          <xsl:when test="Contract/@State[.='EXPIRED']">
            <xsl:text>просрочена</xsl:text>
          </xsl:when>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01">
        <xsl:choose>
          <xsl:when test="Contract/Settlement/@Date[.='']">
            <xsl:text></xsl:text>
          </xsl:when>
          <xsl:when test="Contract/Settlement/@Date">
            <xsl:value-of select="Contract/Settlement/@Date" />
          </xsl:when>
          <xsl:otherwise>
            <xsl:text></xsl:text>
          </xsl:otherwise>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01">
        <xsl:choose>
          <xsl:when test="Contract/@ExecMoment[.='']">
            <xsl:text></xsl:text>
          </xsl:when>
          <xsl:when test="Contract/@ExecMoment">
            <xsl:value-of select="substring(Contract/@ExecMoment, 1, 10)" />
          </xsl:when>
          <xsl:otherwise>
            <xsl:text></xsl:text>
          </xsl:otherwise>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="CounterParty/@ContrCode" />
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="CounterParty/@ContrClientCode" />
      </td>

    </tr>

  </xsl:template>

</xsl:stylesheet>