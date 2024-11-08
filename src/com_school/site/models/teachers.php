<?php

// Ensure this file is included in Joomla.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\DatabaseQuery;

/**
 * Teachers Model for com_school.
 */
class com_schoolModelTeachers extends ListModel
{
    /**
     * Constructor.
     *
     * @param array $config An optional associative array of configuration settings.
     */
    public function __construct($config = [])
    {
        $config['filter_fields'] = isset($config['filter_fields']) ? $config['filter_fields'] : ['id', 'fname', 'user_id', 'department'];
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     */
    protected function populateState($ordering = 'id', $direction = 'ASC')
    {
        // Load the filter state.
        $app = Factory::getApplication();
        $search = $app->input->getString('filter_search');
        $this->setState('filter.search', $search);
        
        $userId = $app->input->getInt('filter_user_id');
        $this->setState('filter.user_id', $userId);

        $department = $app->input->getString('filter_department');
        $this->setState('filter.department', $department);

        // Load the list state.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return DatabaseQuery The SQL query to load data.
     */
    protected function getListQuery()
    {
        // Create a new database query instance.
        $db    = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select', 'DISTINCT a.*'
            )
        );

        $query->from($db->quoteName('#__school_teachers', 'a'));

        // Join over the users for the checked out user.
        $query->select($db->quoteName('uc.name', 'uEditor'));
        $query->join('LEFT', $db->quoteName('#__users', 'uc') . ' ON uc.id = a.checked_out');

        // Join over the created by field 'created_by'
        $query->join('LEFT', $db->quoteName('#__users', 'created_by') . ' ON created_by.id = a.created_by');

        // Join over the modified by field 'modified_by'
        $query->join('LEFT', $db->quoteName('#__users', 'modified_by') . ' ON modified_by.id = a.modified_by');

        // Apply access filter
        if (!Factory::getUser()->authorise('core.edit', 'com_school')) {
            $query->where('a.state = 1');
        }

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = '%' . $db->escape($search, true) . '%';
                $query->where('(a.fname LIKE ' . $db->quote($search) . ')');
            }
        }

        // Filtering by user_id
        $filterUserId = $this->state->get('filter.user_id');
        if (!empty($filterUserId)) {
            $query->where('a.user_id = ' . (int) $filterUserId);
        }

        // Filtering by department
        $filterDepartment = $this->state->get('filter.department');
        if (!empty($filterDepartment)) {
            $query->where('a.department = ' . $db->quote($filterDepartment));
        }

        // Add the list ordering clause.
        $orderCol  = $this->state->get('list.ordering', 'id');
        $orderDirn = $this->state->get('list.direction', 'ASC');

        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        }

        return $query;
    }

    /**
     * Get a Table instance for the teachers.
     *
     * @param string $type   The table type to instantiate.
     * @param string $prefix A prefix for the table class name.
     * @param array  $config Configuration array for the model.
     *
     * @return \JTable A database object.
     */
    public function getTable($type = 'Teachers', $prefix = 'SchoolTable', $config = [])
    {
        return parent::getTable($type, $prefix, $config);
    }

    /**
     * Validate a given date.
     *
     * @param string $date Date to validate.
     *
     * @return bool True if the date is valid, otherwise false.
     */
    public function isValidDate($date)
    {
        $timestamp = strtotime($date);
        return $timestamp !== false;
    }

    /**
     * Retrieve the list of items, validating dates if necessary.
     *
     * @return array|bool Array of items or false on failure.
     */
    public function getItems()
    {
        $items = parent::getItems();
        foreach ($items as &$item) {
            if (isset($item->joining_date) && !$this->isValidDate($item->joining_date)) {
                $item->joining_date = null; // Handle invalid date
            }
        }
        return $items;
    }
}
