<?php

namespace GeorgRinger\Ieb\Service;

use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use Rogervila\ArrayDiffMultidimensional;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DiffService
{

    protected FileRepository $fileRepository;

    public function __construct(
        protected readonly array $forcedOverlayCurrent = [],
        protected readonly array $forcedOverlayPrevious = []
    )
    {
        $this->fileRepository = GeneralUtility::makeInstance(FileRepository::class);
    }

    public function generateDiff(int $ansuchenId, int $basedOn): array
    {
        $final = [];

        $current = $this->getRaw($ansuchenId, $this->forcedOverlayCurrent);
        $previous = $this->getRaw($basedOn, $this->forcedOverlayPrevious);

        if ($previous && (($current['pid'] ?? 0) !== ($previous['pid'] ?? 0))) {
            throw new \UnexpectedValueException('Cannot compare ansuchen with different pid');
        }

//        $current = $this->getRaw(22);
//        $previous = $this->getRaw(12);

        $modifiedOrAdded = ArrayDiffMultidimensional::compare($current, $previous);
//        DebuggerUtility::var_dump($previous);
//        DebuggerUtility::var_dump($current);die;
        foreach ($modifiedOrAdded as $field => $change) {
            if (is_scalar($change)) {
                $final[$field]['previous'] = $previous[$field] ?? null;
                $final[$field]['current'] = $current[$field] ?? null;
            } elseif (is_array($change)) {
                foreach ($change as $id => $rel) {
                    if (is_array($rel)) {
                        foreach ($rel as $relField => $relChange) {
                            if (is_scalar($relChange)) {
                                $final[$field][$id][$relField]['previous'] = $previous[$field][$id][$relField] ?? null;
                                $final[$field][$id][$relField]['current'] = $current[$field][$id][$relField] ?? null;
                            } elseif (is_array($relChange)) {
                                foreach ($relChange as $relId => $relRel) {
                                    $final[$field][$id][$relField][$relId]['previous'] = $previous[$field][$id][$relField][$relId] ?? null;
                                    $final[$field][$id][$relField][$relId]['current'] = $current[$field][$id][$relField][$relId] ?? null;
                                }
                            }
                        }
                    } elseif (is_scalar($rel)) {
                        $final[$field][$id]['previous'] = $previous[$field][$id] ?? null;
                        $final[$field][$id]['current'] = $current[$field][$id] ?? null;
                    }
                }
            }
        }

//        // todo check if something is *removed* in current
//        // todo what if a raw is empty!!
        $result2 = ArrayDiffMultidimensional::compare($previous, $current);

        foreach ($result2 as $field => $change) {
            if (is_string($change)) {
                if (!isset($final[$field])) {
                    $final[$field]['previous'] = $previous[$field] ?? null;
                    $final[$field]['current'] = $current[$field] ?? null;
                }
            } elseif (is_array($change)) {
                foreach ($change as $id => $rel) {
                    if (is_array($rel)) {
                        foreach ($rel as $relField => $relChange) {
                            if (is_string($relChange)) {
                                if (!isset($final[$field][$id][$relField])) {
                                    $final[$field][$id][$relField]['previous'] = $previous[$field][$id][$relField] ?? null;
                                    $final[$field][$id][$relField]['current'] = $current[$field][$id][$relField] ?? null;
                                }
                            } elseif (is_array($relChange)) {
                                foreach ($relChange as $relId => $relRel) {
                                    if (!isset($final[$field][$id][$relField][$relId])) {
                                        $final[$field][$id][$relField][$relId]['previous'] = $previous[$field][$id][$relField][$relId] ?? null;
                                        $final[$field][$id][$relField][$relId]['current'] = $current[$field][$id][$relField][$relId] ?? null;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

//        print_r($modifiedOrAdded);
//        print_r($final);
//        die;
        return $final;
    }

    protected function getRaw(int $id, array $overlay = []): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');

        $row = $queryBuilder
            ->select('*')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAssociative();

        if (!$row) {
            return [];
        }

        $row = array_merge($row, $overlay);

        foreach (['tstamp', 'crdate', 'version', 'version_based_on', 'version_active', 'status', 'cruser_id', 'locked_by'] as $field) {
            unset($row[$field]);
        }
        // json fields
        foreach (['copy_stammdaten', 'copy_berater', 'copy_trainer', 'copy_standorte', 'copy_verantwortliche', 'copy_verantwortliche_mail'] as $field) {
            if (!empty($row[$field])) {
                $items = json_decode($row[$field], true);
                foreach ($items as $k => $item) {
                    if (isset($items[$k]['tstamp'])) {
                        unset($items[$k]['tstamp']);
                    }
                    if (isset($items[$k]['reviewC2BabiCommentInternalStep'])) {
                        unset($items[$k]['reviewC2BabiCommentInternalStep']);
                    }
                    if (isset($items[$k]['reviewC2BabiCommentInternal'])) {
                        unset($items[$k]['reviewC2BabiCommentInternal']);
                    }
                    if (isset($items[$k]['reviewC2PsaCommentInternalStep'])) {
                        unset($items[$k]['reviewC2PsaCommentInternalStep']);
                    }
                    if (isset($items[$k]['reviewC2PsaCommentInternal'])) {
                        unset($items[$k]['reviewC2PsaCommentInternal']);
                    }
                    if (isset($items[$k]['reviewC2BabiCommentTr'])) {
                        unset($items[$k]['reviewC2BabiCommentTr']);
                    }
                    if (isset($items[$k]['reviewC2PsaCommentTr'])) {
                        unset($items[$k]['reviewC2PsaCommentTr']);
                    }
                    if (isset($items[$k]['reviewC21PsaStatus'])) {
                        unset($items[$k]['reviewC21PsaStatus']);
                    }
                    if (isset($items[$k]['reviewC22PsaStatus'])) {
                        unset($items[$k]['reviewC22PsaStatus']);
                    }
                    if (isset($items[$k]['reviewC21BabiStatus'])) {
                        unset($items[$k]['reviewC21BabiStatus']);
                    }
                    if (isset($items[$k]['reviewC22BabiStatus'])) {
                        unset($items[$k]['reviewC22BabiStatus']);
                    }
                    if (isset($items[$k]['reviewFristMailSent14t'])) {
                        unset($items[$k]['reviewFristMailSent14t']);
                    }
                    if (isset($items[$k]['reviewFristMailSent1t'])) {
                        unset($items[$k]['reviewFristMailSent1t']);
                    }
                    if (isset($items[$k]['statusAfterReviewBabi'])) {
                        unset($items[$k]['statusAfterReviewBabi']);
                    }
                    if (isset($items[$k]['statusAfterReviewPsa'])) {
                        unset($items[$k]['statusAfterReviewPsa']);
                    }
                    if (isset($items[$k]['reviewC3CommentInternalStep'])) {
                        unset($items[$k]['reviewC3CommentInternalStep']);
                    }
                    if (isset($items[$k]['reviewC3CommentInternal'])) {
                        unset($items[$k]['reviewC3CommentInternal']);
                    }
                    if (isset($items[$k]['reviewC3CommentTr'])) {
                        unset($items[$k]['reviewC3CommentTr']);
                    }
                    if (isset($items[$k]['reviewC3Status'])) {
                        unset($items[$k]['reviewC3Status']);
                    }
                    if (isset($items[$k]['reviewC32Status'])) {
                        unset($items[$k]['reviewC32Status']);
                    }
                    if (isset($items[$k]['reviewA1GsCommentInternalStep'])) {
                        unset($items[$k]['reviewA1GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewA2GsCommentInternalStep'])) {
                        unset($items[$k]['reviewA2GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewA1Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewA1Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewA2Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewA2Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewA1Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewA1Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewA2Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewA2Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB1GsCommentInternalStep'])) {
                        unset($items[$k]['reviewB1GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewB14GsCommentInternalStep'])) {
                        unset($items[$k]['reviewB14GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewB15GsCommentInternalStep'])) {
                        unset($items[$k]['reviewB15GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewB2GsCommentInternalStep'])) {
                        unset($items[$k]['reviewB2GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewB22GsCommentInternalStep'])) {
                        unset($items[$k]['reviewB22GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewB23GsCommentInternalStep'])) {
                        unset($items[$k]['reviewB23GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewC1GsCommentInternalStep'])) {
                        unset($items[$k]['reviewC1GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2GsCommentInternalStep'])) {
                        unset($items[$k]['reviewC2GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewC3GsCommentInternalStep'])) {
                        unset($items[$k]['reviewC3GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewTotalGsCommentInternalStep'])) {
                        unset($items[$k]['reviewTotalGsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewB1Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewB1Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB14Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewB14Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB15Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewB15Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB2Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewB2Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB22Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewB22Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB23Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewB23Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC1Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewC1Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewC2Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC3Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewC3Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewTotalAg1CommentInternalStep'])) {
                        unset($items[$k]['reviewTotalAg1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB1Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewB1Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB14Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewB14Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB15Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewB15Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB2Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewB2Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB22Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewB22Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewB23Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewB23Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC1Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewC1Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewC2Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC3Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewC3Ag2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewTotalAg2CommentInternalStep'])) {
                        unset($items[$k]['reviewTotalAg2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2BabiGsCommentInternalStep'])) {
                        unset($items[$k]['reviewC2BabiGsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2PsaGsCommentInternalStep'])) {
                        unset($items[$k]['reviewC2PsaGsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2BabiAg1CommentInternalStep'])) {
                        unset($items[$k]['reviewC2BabiAg1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2PsaAg1CommentInternalStep'])) {
                        unset($items[$k]['reviewC2PsaAg1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2BabiAg2CommentInternalStep'])) {
                        unset($items[$k]['reviewC2BabiAg2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC2PsaAg2CommentInternalStep'])) {
                        unset($items[$k]['reviewC2PsaAg2CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC3GsCommentInternalStep'])) {
                        unset($items[$k]['reviewC3GsCommentInternalStep']);
                }
                if (isset($items[$k]['reviewC3Ag1CommentInternalStep'])) {
                        unset($items[$k]['reviewC3Ag1CommentInternalStep']);
                }
                if (isset($items[$k]['reviewC3Ag2CommentInternalStep'])) {
                        unset($items[$k]['reviewC3Ag2CommentInternalStep']);
                }
                }
                $row[$field] = $items;
            }

        }

        // bundesland
        $bl = array_column(BundeslandEnum::cases(), 'name', 'value');
        $row['bundesland'] = $bl[$row['bundesland']] ?? 'error mit bundesland';

        // files
        foreach (['lernziele', 'lernstandserhebung', 'diversity', 'beratung_datei', 'pruefbescheid_datei', 'kooperation_datei', 'uebersicht_datei', 'zielgruppen_ansprache_datei'] as $fileField) {
            $row[$fileField] = $this->getFilesOfRelation($fileField, $id);
        }

        return $row;
    }

    protected function getFilesOfRelation(string $field, int $id): array
    {
        $result = [];
        $files = $this->fileRepository->findByRelation('tx_ieb_domain_model_ansuchen', $field, $id);
        foreach ($files as $reference) {
            if ($reference->getOriginalFile()) {
                /** @var FileReference $reference */
                $result[$reference->getOriginalFile()->getUid()] = [
                    'publicUrl' => $reference->getOriginalFile()->getPublicUrl(),
                ];
            }
        }
        return $result;
    }
}



