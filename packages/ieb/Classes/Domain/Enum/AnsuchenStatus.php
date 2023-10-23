<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Enum;

enum AnsuchenStatus: int
{
    case NEU = 0;
    case NEU_IN_ARBEIT = 10;
    case EINGEREICHT_ERSTEINREICHUNG = 20;
    case IN_ARBEIT = 30;
    case BEGUTACHTET_NACH_ERSTEINREICHUNG = 40;
    //case EINGEREICHT_ZUR_BEGUTACHTUNG_2 = 42;
    //case ERSTBEGUTACHTUNG_DURCH_AG = 50;
    //case FESTLEGUNG_EINES_AKKREDITIERUNGSSTATUS = 60;
    case NACHBESSERUNGSAUFTRAG = 80;
    case EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG = 82;
    case BEGUTACHTET_NACH_EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG = 84;
    case AKKREDITIERT = 100;
    //case AKKREDITIERT_MUSS_NACHAKKREDITIERT_WERDEN = 110;
    case AKKREDITIERT_IN_ARBEIT_ZUR_NACHAKKREDITIERUNG = 130;
    case AKKREDITIERT_MIT_AUFLAGEN = 140;
    //case AKKREDITIERT_MIT_AUFLAGEN_MUSS_NOCH_AKKREDITIERT_WERDEN = 142;
    //case EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG = 150;
    case BEGUTACHTET_NACH_AUFLAGENERFUELLUNG = 155;
    case EINGEREICHT_ZUR_NACHAKKREDITIERUNG = 160;
    case BEGUTACHTET_NACH_EINGEREICHT_ZUR_NACHAKKREDITIERUNG = 170;
    case ZURUECK_AN_TR_AKKREDITIERT = 200;
    case ZURUECK_AN_TR_AUFLAGE = 220;
    case NICHT_AKKREDITERT = 800;
    case AKKREDITIERUNG_ENTZOGEN = 810;
    case AKKREDITIERUNG_AUSGESETZT = 820;


    /**
     * Alle Status, von Anträgen, die für die GS sichtbar sind
     *
     * @return array<int>
     */
    public static function statusSichtbarDurchGs(): array
    {
        return [
            self::EINGEREICHT_ERSTEINREICHUNG->value,
            self::BEGUTACHTET_NACH_ERSTEINREICHUNG->value,
            self::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
            self::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value,
            self::EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,
            self::BEGUTACHTET_NACH_AUFLAGENERFUELLUNG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,
        ];
    }

    public static function statusSichtbarDurchAkkreditierungsGruppe(): array
    {
        return self::statusSichtbarDurchGs();
    }

    /**
     * Alle Status, von Anträgen, die für TR bearbeitbar sind
     *
     * @return array<int>
     */
    public static function statusBearbeitbarDurchTr(): array
    {
        return [
            self::NEU_IN_ARBEIT->value,
            self::IN_ARBEIT->value,
            self::NACHBESSERUNGSAUFTRAG->value,
            self::AKKREDITIERT->value,
            self::ZURUECK_AN_TR_AKKREDITIERT->value,
            self::ZURUECK_AN_TR_AUFLAGE->value,
            self::AKKREDITIERT_IN_ARBEIT_ZUR_NACHAKKREDITIERUNG->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
        ];
    }

    /**
     * Ist ein Status, von Ansuchen, das für TR bearbeitbar ist
     *
     * @return array<int>
     */
    public static function statusBearbeitbarDurchTrCheck(int $value): bool
    {
        return in_array($value, [
            self::NEU_IN_ARBEIT->value,
            self::IN_ARBEIT->value,
            self::NACHBESSERUNGSAUFTRAG->value,
            self::AKKREDITIERT->value,
            self::AKKREDITIERT_IN_ARBEIT_ZUR_NACHAKKREDITIERUNG->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
            self::ZURUECK_AN_TR_AKKREDITIERT->value,
            self::ZURUECK_AN_TR_AUFLAGE->value,
        ], true);
    }

    /**
     * Alle Status, von Anträgen, die für die GS gesetzt werden können
     *
     * @return array<int>
     */
    public static function statusSetzbarDurchGs(): array
    {
        return [
            self::NACHBESSERUNGSAUFTRAG->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
            self::AKKREDITIERT->value,
            self::BEGUTACHTET_NACH_ERSTEINREICHUNG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
            self::BEGUTACHTET_NACH_AUFLAGENERFUELLUNG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,        
            self::ZURUECK_AN_TR_AKKREDITIERT->value,
            self::ZURUECK_AN_TR_AUFLAGE->value,
            self::NICHT_AKKREDITERT->value,
            self::AKKREDITIERUNG_ENTZOGEN->value,
            self::AKKREDITIERUNG_AUSGESETZT->value,
        ];
    }

    /**
     * Alle Status, die verhindern, dass relationen geändert werden können
     *
     * @return array<int>
     */
    public static function statusRelationenGesperrt(): array
    {
        return [
            self::EINGEREICHT_ERSTEINREICHUNG->value,
            self::BEGUTACHTET_NACH_ERSTEINREICHUNG->value,
            self::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
            self::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value,
            self::EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,
            self::BEGUTACHTET_NACH_AUFLAGENERFUELLUNG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,
        ];
    }

    /**
     * @return int[]
     */
    public static function statusForMonitoringExport(): array
    {
        return [
            self::AKKREDITIERT->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
            self::AKKREDITIERUNG_ENTZOGEN->value,
            self::NICHT_AKKREDITERT->value,
        ];
    }

    /**
     * @return int[]
     */
    public static function statusForFristMails(): array
    {
        return [
            self::AKKREDITIERT->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
        ];
    }

     /**
     * @return int[]
     */
    public static function statusAkkreditiert(): array
    {
        return [
            self::AKKREDITIERT->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
            self::AKKREDITIERUNG_ENTZOGEN->value,
            self::AKKREDITIERT_MUSS_NACHAKKREDITIERT_WERDEN->value,
            self::AKKREDITIERT_IN_ARBEIT_ZUR_NACHAKKREDITIERUNG->value,
            self::ZURUECK_AN_TR_AKKREDITIERT->value,
            self::ZURUECK_AN_TR_AUFLAGE->value,
            self::AKKREDITIERT_MIT_AUFLAGEN_MUSS_NOCH_AKKREDITIERT_WERDEN->value,
            self::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value,
            self::EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,
            self::BEGUTACHTET_NACH_ERSTEINREICHUNG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
            self::BEGUTACHTET_NACH_AUFLAGENERFUELLUNG->value,
            self::BEGUTACHTET_NACH_EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value,
        ];
    }
     /**
     * @return int[]
     */
    public static function statusAkkreditiertBeiTr(): array
    {
        return [
            self::NEU->value,
            self::NEU_IN_ARBEIT->value,
            self::AKKREDITIERT->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
            self::AKKREDITIERUNG_ENTZOGEN->value,
            self::AKKREDITIERT_MUSS_NACHAKKREDITIERT_WERDEN->value,
            self::AKKREDITIERT_IN_ARBEIT_ZUR_NACHAKKREDITIERUNG->value,
            self::ZURUECK_AN_TR_AKKREDITIERT->value,
            self::ZURUECK_AN_TR_AUFLAGE->value,
            self::AKKREDITIERT_MIT_AUFLAGEN_MUSS_NOCH_AKKREDITIERT_WERDEN->value
        ];
    }
}
