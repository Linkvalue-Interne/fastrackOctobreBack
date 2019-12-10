<?php


namespace App\Component\builder;

class SkillBuilder
{
    /**
     * @param array $data
     * @return array
     */
    public function formatList(array $data): array
    {
        $result = [];

        foreach ($data as $category) {
            $formatList =  [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'subCategory' => [],
                'skills' => $category->getSkills()->toArray(),
                ]
            ;

            if ($category->getParentId()) {
                $result[$category->getParentId()]['subCategory'][] = $formatList;

                continue;
            }

            $result[$category->getId()] = $formatList;
        }

        return $result;
    }
}
