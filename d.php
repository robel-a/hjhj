 public function getEmployeeById($employeeID)
    {
        try {

            $employee = Employee::findOrFail($employeeID);

            return response()->json([
                'employeeFullName' => $employee->name,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Employee not found',
            ], 404);
        }
    }