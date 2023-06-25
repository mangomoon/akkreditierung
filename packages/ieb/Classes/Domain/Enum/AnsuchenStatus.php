<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Enum;

enum AnsuchenStatus: int
{
    case NEU_IN_ARBEIT = 10;
    case EINGEREICHT_ERSTEINREICHUNG = 20;
    case IN_ARBEIT = 30;
    case EINGEREICHT_ZUR_BEGUTACHTUNG = 40;
    case EINGEREICHT_ZUR_BEGUTACHTUNG_2 = 42;
    case ERSTBEGUTACHTUNG_DURCH_AG = 50;
    case FESTLEGUNG_EINES_AKKREDITIERUNGSSTATUS = 60;
    case NACHBESSERUNGSAUFTRAG = 80;
    case EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG = 82;
    case BEGUTACHTUNG_NACH_EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG = 84;
    case AKKREDITIERT = 100;
    case AKKREDITIERT_MUSS_NACHAKKREDITIERT_WERDEN = 110;
    case AKKREDITIERUNG_AUSGESETZT = 120;
    case AKKREDITIERT_IN_ARBEIT_ZUR_NACHAKKREDITIERUNG = 130;
    case AKKREDITIERT_MIT_AUFLAGEN = 140;
    case AKKREDITIERT_MIT_AUFLAGEN_MUSS_NOCH_AKKREDITIERT_WERDEN = 142;
    case EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG = 150;
    case BEGUTACHTUNG_NACH_EINREICHUNG_NACH_AKKREDITIERUNG = 160;
    case NICHT_AKKREDITERT = 800;
    case AKKREDITIERUNG_ENTZOGEN = 810;

    public static function visibleForAg(int $value): bool
    {
        return in_array($value, [self::NEU_IN_ARBEIT->value, self::EINGEREICHT_ERSTEINREICHUNG->value], true);
    }

    /**
     * Alle Status, von Anträgen, die für die GS sichtbar sind
     *
     * @return array<int>
     */
    public static function statusSichtbarDurchGs(): array
    {
        return [
            self::EINGEREICHT_ERSTEINREICHUNG->value,
            self::EINGEREICHT_ZUR_BEGUTACHTUNG->value,
            self::EINGEREICHT_ZUR_BEGUTACHTUNG_2->value,
            self::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
        ];
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
        ];
    }

    /**
     * Alle Status, von Anträgen, die für die GS sichtbar sind
     *
     * @return array<int>
     */
    public static function statusSetzbarDurchGs(): array
    {
        return [
            self::NACHBESSERUNGSAUFTRAG->value,
            self::AKKREDITIERT_MIT_AUFLAGEN->value,
            self::AKKREDITIERT->value,
            self::AKKREDITIERUNG_AUSGESETZT->value,
            self::NICHT_AKKREDITERT->value,
            self::AKKREDITIERUNG_ENTZOGEN->value,
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
            self::EINGEREICHT_ZUR_BEGUTACHTUNG->value,
            self::EINGEREICHT_ZUR_BEGUTACHTUNG_2->value,
            self::ERSTBEGUTACHTUNG_DURCH_AG->value,
            self::FESTLEGUNG_EINES_AKKREDITIERUNGSSTATUS->value,
            self::EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
            self::BEGUTACHTUNG_NACH_EINGEREICHT_NACH_NACHBESSERUNGSAUFTRAG->value,
        ];
    }
}
