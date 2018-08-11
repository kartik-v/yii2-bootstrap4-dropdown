<?php
/**
 * @package   yii2-bootstrap4-dropdown
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2018
 * @version   1.0.0
 */

namespace kartik\bs4dropdown;

use yii\bootstrap4\Dropdown as Bs4Dropdown;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;

/**
 * Dropdown renders a Bootstrap dropdown menu component. This widget extends the default
 * `yii\bootstrap4\Dropdown` widget to include nested submenu behavior and styling.
 *
 * For example,
 *
 * ```php
 * <div class="dropdown">
 *     <?php
 *         echo \yii\helpers\Html::button('Dropdown Button', [
 *             'id' => 'dropdownMenuButton',
 *             'class' => 'btn btn-secondary dropdown-toggle'
 *             'data-toggle' => 'dropdown',
 *             'aria-haspopup' => 'true',
 *             'aria-expanded' => 'false'
 *         ]);
 *         echo Dropdown::widget([
 *             'items' => [
 *                 ['label' => 'Section 1', 'url' => '/'],
 *                 ['label' => 'Section 2', 'url' => '#'],
 *                 [
 *                      'label' => 'Section 3',
 *                      'items' => [
 *                          ['label' => 'Section 3.1', 'url' => '/'],
 *                          ['label' => 'Section 3.2', 'url' => '#'],
 *                          [
 *                              'label' => 'Section 3.3',
 *                              'items' => [
 *                                  ['label' => 'Section 3.3.1', 'url' => '/'],
 *                                  ['label' => 'Section 3.3.2', 'url' => '#'],
 *                              ],
 *                          ],
 *                      ],
 *                  ],
 *             ],
 *             'options' => ['aria-labelledby' => 'dropdownMenuButton']
 *         ]);
 *     ?>
 * </div>
 * ```
 * @see http://getbootstrap.com/javascript/#dropdowns
 */
class Dropdown extends Bs4Dropdown
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        DropdownAsset::register($this->getView());
        return parent::run();
    }

    /**
     * Renders menu items.
     * @param array $items the menu items to be rendered
     * @param array $options the container HTML attributes
     * @return string the rendering result.
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     * @throws \Exception
     */
    protected function renderItems($items, $options = [])
    {
        $lines = [];
        foreach ($items as $item) {
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            Html::addCssClass($linkOptions, 'dropdown-item');
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            $label .= ' ' . !!$encodeLabel . ' ' . !!$this->encodeLabels;
            if (empty($item['items'])) {
                if ($url === null) {
                    $content = Html::tag('h6', $label, ['class' => 'dropdown-header']);
                } else {
                    $content = Html::a($label, $url, $linkOptions);
                }
                $lines[] = $content;
            } else {
                $submenuOptions = $this->submenuOptions;
                if (isset($item['submenuOptions'])) {
                    $submenuOptions = array_merge($submenuOptions, $item['submenuOptions']);
                }
                Html::addCssClass($submenuOptions, ['dropdown-submenu']);
                Html::addCssClass($linkOptions, ['dropdown-toggle']);

                $lines[] = Html::beginTag('div', ['class' => ['dropdown'], 'aria-expanded' => 'false']);
                $lines[] = Html::a($label, $url, array_merge([
                    'data-toggle' => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'role' => 'button',
                ], $linkOptions));
                $lines[] = static::widget([
                    'items' => $item['items'],
                    'options' => $submenuOptions,
                    'submenuOptions' => $submenuOptions,
                    'encodeLabels' => $this->encodeLabels,
                ]);
                $lines[] = Html::endTag('div');
            }
        }

        return Html::tag('div', implode("\n", $lines), $options);
    }
}
