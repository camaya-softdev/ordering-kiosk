import { useState, useEffect, useRef } from 'react';
import styles from './Common.module.css';
import { LazyLoadImage } from 'react-lazy-load-image-component';

function Slideshow({items}) {
    const [currentSlide, setCurrentSlide] = useState(0);
    const videoRef = useRef(null);
    const isVideo = useRef(false);
    const swipeRef = useRef(null);
    const touchStartPos = useRef(0);

    useEffect(() => {
        const timer = setInterval(() => {
            if (!isVideo.current || (videoRef.current && videoRef.current.ended)) {
                nextSlide();
            }
        }, 5000);
        return () => clearInterval(timer);
    }, [currentSlide]);

    const nextSlide = () => {
        setCurrentSlide((currentSlide + 1) % items.length);
    };

    const prevSlide = () => {
        setCurrentSlide((currentSlide - 1 + items.length) % items.length);
    };

    useEffect(() => {
        isVideo.current = items[currentSlide].includes('.mp4');
    }, [currentSlide]);

    const handleTouchStart = (e) => {
        touchStartPos.current = e.touches[0].clientX;
    };

    const handleTouchMove = (e) => {
        const touchEndPos = e.changedTouches[0].clientX;
        const diff = touchStartPos.current - touchEndPos;

        if (diff > 70) { // swiped left
            nextSlide();
        } else if (diff < -70) { // swiped right
            prevSlide();
        }
    };

    return (
        <div 
            className={styles.slideshowWrapper} 
            ref={swipeRef} 
            onTouchStart={handleTouchStart} 
            onTouchEnd={handleTouchMove}
        >
            {items[currentSlide].includes('.mp4') ? (
                <video 
                    ref={videoRef} 
                    src={items[currentSlide]} 
                    autoPlay 
                    muted
                    onEnded={nextSlide}
                />
            ) : (
                <LazyLoadImage src={items[currentSlide]} alt="current slide" />
            )}
        </div>
    );
}

export default Slideshow;