<?php  namespace Hex\Tickets\Validators;

use Illuminate\Validation\Factory;
use Hex\Validation\ValidationException;
use Hex\Validation\ValidatorInterface;
use Hex\CommandBus\CommandInterface;

class CreateTicketValidator implements ValidatorInterface {

    /**
     * @var \Illuminate\Validation\Factory
     */
    private $validator;

    /**
     * @var array
     */
    protected $rules = [
        'subject' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'category_id' => 'required|exists:categories,id',
        'staffer_id' => 'required|exists:staff,id',
        'message' => 'required',
    ];

    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param \Hex\CommandBus\CommandInterface $command
     * @throws \Hex\Validation\ValidationException
     */
    public function validate(CommandInterface $command)
    {
        $validator = $this->validator->make([
            'subject' => $command->subject,
            'name' => $command->name,
            'email' => $command->email,
            'category_id' => $command->category_id,
            'staffer_id' => $command->staffer_id,
            'message' => $command->message,
        ], $this->rules);

        if( ! $validator->passes() )
        {
            throw new ValidationException( $validator->errors() );
        }
    }
}