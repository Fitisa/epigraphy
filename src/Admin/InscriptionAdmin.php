<?php

declare(strict_types=1);

/*
 * This file is part of «Epigraphy of Medieval Rus'» database.
 *
 * Copyright (c) National Research University Higher School of Economics
 *
 * «Epigraphy of Medieval Rus'» database is free software:
 * you can redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation, version 3.
 *
 * «Epigraphy of Medieval Rus'» database is distributed
 * in the hope  that it will be useful, but WITHOUT ANY WARRANTY; without even
 * the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. If you have not received
 * a copy of the GNU General Public License along with
 * «Epigraphy of Medieval Rus'» database,
 * see <http://www.gnu.org/licenses/>.
 */

namespace App\Admin;

use App\Admin\Abstraction\AbstractEntityAdmin;
use App\Persistence\Entity\Epigraphy\Interpretation;
use App\Persistence\Repository\Epigraphy\InterpretationRepository;
use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @author Anton Dyshkant <vyshkant@gmail.com>
 */
final class InscriptionAdmin extends AbstractEntityAdmin
{
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id', null, $this->createLabeledListOptions('id'))
            ->add('carrier', null, $this->createLabeledListOptions('carrier'))
            ->add('interpretations', null, $this->createLabeledListOptions('interpretations'))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $parentInscriptionId = $formMapper->getAdmin()->getSubject()->getId();

        $referencesOptions = [
            'class' => Interpretation::class,
            'query_builder' => static function (InterpretationRepository $entityRepository) use ($parentInscriptionId) {
                return $entityRepository
                    ->createQueryBuilder('interpretation')
                    ->where('interpretation.inscription = :inscriptionId')
                    ->setParameter(':inscriptionId', $parentInscriptionId);
            },
        ];

        $formMapper
            ->tab('form.inscription.tab.carrier.label')
                ->with('form.inscription.section.carrier.label')
                    ->add(
                        'carrier',
                        ModelType::class,
                        $this->createLabeledFormOptions('carrier', ['required' => true])
                    )
                ->end()
            ->end()
            ->tab('form.inscription.tab.actualResearchInformation.label')
                ->with('form.inscription.section.zeroRowMaterialAspect.label', ['class' => 'col-md-6'])
                    ->add(
                        'zeroRow.placeOnCarrier',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.placeOnCarrier', ['required' => false])
                    )
                    ->add(
                        'zeroRow.placeOnCarrierReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.placeOnCarrierReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.writingTypes',
                        ModelType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.writingTypes')
                    )
                    ->add(
                        'zeroRow.writingTypesReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.writingTypesReferences', $referencesOptions)
                    )
                    ->add(
                        'zeroRow.writingMethods',
                        ModelType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.writingMethods')
                    )
                    ->add(
                        'zeroRow.writingMethodsReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.writingMethodsReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.preservationStates',
                        ModelType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.preservationStates')
                    )
                    ->add(
                        'zeroRow.preservationStatesReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.preservationStatesReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.materials',
                        ModelType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.materials')
                    )
                    ->add(
                        'zeroRow.materialsReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.materialsReferences', $referencesOptions)
                    )
                ->end()
                ->with('form.inscription.section.zeroRowLinguisticAspect.label', ['class' => 'col-md-6'])
                    ->add(
                        'zeroRow.alphabets',
                        ModelType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.alphabets')
                    )
                    ->add(
                        'zeroRow.alphabetsReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.alphabetsReferences', $referencesOptions)
                    )
                    ->add(
                        'zeroRow.text',
                        TextareaType::class,
                        $this->createLabeledFormOptions('zeroRow.text', ['required' => false])
                    )
                    ->add(
                        'zeroRow.textReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.textReferences', $referencesOptions)
                    )
                    ->add(
                        'zeroRow.textImageFileNames',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.textImageFileNames', ['required' => false])
                    )
                    ->add(
                        'zeroRow.textImageFileNamesReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.textImageFileNamesReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.transliteration',
                        TextareaType::class,
                        $this->createLabeledFormOptions('zeroRow.transliteration', ['required' => false])
                    )
                    ->add(
                        'zeroRow.transliterationReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.transliterationReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.translation',
                        TextareaType::class,
                        $this->createLabeledFormOptions('zeroRow.translation', ['required' => false])
                    )
                    ->add(
                        'zeroRow.translationReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.translationReferences', $referencesOptions)
                    )
                    ->add(
                        'zeroRow.contentCategories',
                        ModelType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.contentCategories')
                    )
                    ->add(
                        'zeroRow.contentCategoriesReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.contentCategoriesReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.content',
                        TextareaType::class,
                        $this->createLabeledFormOptions('zeroRow.content', ['required' => false])
                    )
                    ->add(
                        'zeroRow.contentReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.contentReferences', $referencesOptions)
                    )
                ->end()
                ->with('form.inscription.section.zeroRowHistoricalAspect.label', ['class' => 'col-md-6'])
                    ->add(
                        'zeroRow.dateInText',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.dateInText', ['required' => false])
                    )
                    ->add(
                        'zeroRow.dateInTextReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions('zeroRow.dateInTextReferences', $referencesOptions)
                    )
                    ->add(
                        'zeroRow.stratigraphicalDate',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.stratigraphicalDate', ['required' => false])
                    )
                    ->add(
                        'zeroRow.stratigraphicalDateReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.stratigraphicalDateReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.nonStratigraphicalDate',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.nonStratigraphicalDate', ['required' => false])
                    )
                    ->add(
                        'zeroRow.nonStratigraphicalDateReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.nonStratigraphicalDateReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.historicalDate',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.historicalDate', ['required' => false])
                    )
                    ->add(
                        'zeroRow.historicalDateReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.historicalDateReferences',
                            $referencesOptions
                        )
                    )
                ->end()
                ->with('form.inscription.section.zeroRowMultimedia.label', ['class' => 'col-md-6'])
                    ->add(
                        'zeroRow.photoFileNames',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.photoFileNames', ['required' => false])
                    )
                    ->add(
                        'zeroRow.photoFileNamesReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.photoFileNamesReferences',
                            $referencesOptions
                        )
                    )
                    ->add(
                        'zeroRow.sketchFileNames',
                        TextType::class,
                        $this->createLabeledFormOptions('zeroRow.sketchFileNames', ['required' => false])
                    )
                    ->add(
                        'zeroRow.sketchFileNamesReferences',
                        EntityType::class,
                        $this->createLabeledManyToManyFormOptions(
                            'zeroRow.sketchFileNamesReferences',
                            $referencesOptions
                        )
                    )
                ->end()
            ->end()
            ->tab('form.inscription.tab.interpretations.label')
                ->with('form.inscription.section.interpretations.label')
                    ->add(
                        'interpretations',
                        CollectionType::class,
                        $this->createLabeledFormOptions(
                            'interpretations',
                            ['required' => true, 'by_reference' => false]
                        ),
                        ['edit' => 'inline']
                    )
                ->end()
            ->end()
        ;
    }

    /**
     * @param string $action
     */
    protected function configureTabMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null): void
    {
        if ('edit' === $action || null !== $childAdmin) {
            $admin = $this->isChild() ? $this->getParent() : $this;

            if ((null !== $inscription = $this->getSubject()) && (null !== ($inscriptionId = $inscription->getId()))) {
                $menu->addChild('tabMenu.siteView', [
                    'uri' => $admin->getRouteGenerator()->generate('inscription__show', [
                        'id' => $inscriptionId,
                    ]),
                ]);
            }
        }
    }
}
