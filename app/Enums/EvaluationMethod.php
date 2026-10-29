<?php

namespace App\Enums;

enum EvaluationMethod: string
{
    case DirectTested = 'direct_tested';
    case SpecificationResearch = 'specification_research';

    /**
     * Get the human-readable label for the evaluation method.
     */
    public function label(): string
    {
        return match ($this) {
            self::DirectTested => 'Direct Hands-On Evaluation',
            self::SpecificationResearch => 'Independent Specification Audit',
        };
    }

    /**
     * Get the badge explanation of the methodology.
     */
    public function description(): string
    {
        return match ($this) {
            self::DirectTested => 'Physically evaluated and tested in real-world workflows by the Read2Buy.com editorial desk.',
            self::SpecificationResearch => 'Evaluated through an independent audit of technical specifications, material tolerances, price-to-value benchmarks, and verified long-term feedback.',
        };
    }
}
