<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class RowCellIterator extends CellIterator
{
    /**
     * Row index.
     *
     * @var int
     */
    protected $rowIndex;

    /**
     * Start position.
     *
     * @var int
     */
    protected $startColumn = 0;

    /**
     * End position.
     *
     * @var int
     */
    protected $endColumn = 0;

    /**
     * Create a new column iterator.
     *
     * @param Worksheet $subject The worksheet to iterate over
     * @param int $rowIndex The row that we want to iterate
     * @param string $startColumn The column address at which to start iterating
     * @param string $endColumn Optionally, the column address at which to stop iterating
     */
    public function __construct(Worksheet $subject = null, $rowIndex = 1, $startColumn = 'A', $endColumn = null)
    {
        // Set subject and row index
        $this->subject = $subject;
        $this->rowIndex = $rowIndex;
        $this->resetEnd($endColumn);
        $this->resetStart($startColumn);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        unset($this->subject);
    }

    /**
     * (Re)Set the start column and the current column pointer.
     *
     * @param int $startColumn The column address at which to start iterating
     *
     * @throws PhpSpreadsheetException
     *
     * @return RowCellIterator
     */
    public function resetStart($startColumn = 'A')
    {
        $startColumnIndex = Coordinate::columnIndexFromString($startColumn) - 1;
        $this->startColumn = $startColumnIndex;
        $this->adjustForExistingOnlyRange();
        $this->seek(Coordinate::stringFromColumnIndex($this->startColumn));

        return $this;
    }

    /**
     * (Re)Set the end column.
     *
     * @param string $endColumn The column address at which to stop iterating
     *
     * @throws PhpSpreadsheetException
     *
     * @return RowCellIterator
     */
    public function resetEnd($endColumn = null)
    {
        $endColumn = ($endColumn) ? $endColumn : $this->subject->getHighestColumn();
        $this->endColumn = Coordinate::columnIndexFromString($endColumn) - 1;
        $this->adjustForExistingOnlyRange();

        return $this;
    }

    /**
     * Set the column pointer to the selected column.
     *
     * @param string $column The column address to set the current pointer at
     *
     * @throws PhpSpreadsheetException
     *
     * @return RowCellIterator
     */
    public function seek($column = 'A')
    {
        $column = Coordinate::columnIndexFromString($column) - 1;
        if (($column < $this->startColumn) || ($column > $this->endColumn)) {
            throw new PhpSpreadsheetException("Column $column is out of range ({$this->startColumn} - {$this->endColumn})");
        } elseif ($this->onlyExistingCells && !($this->subject->cellExistsByColumnAndRow($column, $this->rowIndex))) {
            throw new PhpSpreadsheetException('In "IterateOnlyExistingCells" mode and Cell does not exist');
        }
        $this->position = $column;

        return $this;
    }

    /**
     * Rewind the iterator to the starting column.
     */
    public function rewind()
    {
        $this->position = $this->startColumn;
    }

    /**
     * Return the current cell in this worksheet row.
     *
     * @return \PhpOffice\PhpSpreadsheet\Cell\Cell
     */
    public function current()
    {
        return $this->subject->getCellByColumnAndRow($this->position, $this->rowIndex);
    }

    /**
     * Return the current iterator key.
     *
     * @return string
     */
    public function key()
    {
        return Coordinate::stringFromColumnIndex($this->position);
    }

    /**
     * Set the iterator to its next value.
     */
    public function next()
    {
        do {
            ++$this->position;
        } while (($this->onlyExistingCells) && (!$this->subject->cellExistsByColumnAndRow($this->position, $this->rowIndex)) && ($this->position <= $this->endColumn));
    }

    /**
     * Set the iterator to its previous value.
     *
     * @throws PhpSpreadsheetException
     */
    public function prev()
    {
        if ($this->position <= $this->startColumn) {
            throw new PhpSpreadsheetException('Column is already at the beginning of range (' . Coordinate::stringFromColumnIndex($this->endColumn) . ' - ' . Coordinate::stringFromColumnIndex($this->endColumn) . ')');
        }
        do {
            --$this->position;
        } while (($this->onlyExistingCells) && (!$this->subject->cellExistsByColumnAndRow($this->position, $this->rowIndex)) && ($this->position >= $this->startColumn));
    }

    /**
     * Indicate if more columns exist in the worksheet range of columns that we're iterating.
     *
     * @return bool
     */
    public function valid()
    {
        return $this->position <= $this->endColumn;
    }

    /**
     * Validate start/end values for "IterateOnlyExistingCells" mode, and adjust if necessary.
     *
     * @throws PhpSpreadsheetException
     */
    protected function adjustForExistingOnlyRange()
    {
        if ($this->onlyExistingCells) {
            while ((!$this->subject->cellExistsByColumnAndRow($this->startColumn, $this->rowIndex)) && ($this->startColumn <= $this->endColumn)) {
                ++$this->startColumn;
            }
            if ($this->startColumn > $this->endColumn) {
                throw new PhpSpreadsheetException('No cells exist within the specified range');
            }
            while ((!$this->subject->cellExistsByColumnAndRow($this->endColumn, $this->rowIndex)) && ($this->endColumn >= $this->startColumn)) {
                --$this->endColumn;
            }
            if ($this->endColumn < $this->startColumn) {
                throw new PhpSpreadsheetException('No cells exist within the specified range');
            }
        }
    }
}
