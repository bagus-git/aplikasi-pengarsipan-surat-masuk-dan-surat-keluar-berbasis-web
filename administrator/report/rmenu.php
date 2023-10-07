<?php

// Menu
$RootMenu = new crMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(1, "mi_disposisi", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("1", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "disposisirpt.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_petugas", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("2", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "petugasrpt.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_surat_keluar", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("3", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "surat_keluarrpt.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(4, "mi_surat_masuk", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("4", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "surat_masukrpt.php", -1, "", TRUE, FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
