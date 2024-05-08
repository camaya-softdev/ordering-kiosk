import { useDispatch } from 'react-redux';
import BottomModal from '../Common/BottomModal';
import Button from '../Common/Button';
import { resetOrder } from "../../store/order/orderSlice";

function StartOverConfirmation ({open, onClose}){
    const dispatch = useDispatch();

    const handleStartOver = () => {
        dispatch(resetOrder());
        onClose();
    }

    return(
        <BottomModal 
            open={open}
            onClose={onClose}
            title="Are you sure you want to start over?"
            subtitle="Your progress will not be saved."
            extras={
                <>
                    <Button type='white' onClick={onClose}>
                        Cancel
                    </Button>

                    <Button type='black' onClick={handleStartOver}>
                        Confirm
                    </Button>
                </>
            }
        />
    );
}

export default StartOverConfirmation;